<?php

namespace App\Lib;

use App\Models\User;
use App\Lib\FieldName;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Helper
{
   public static function generer_jeton_connexion(User $utilisateur, string $nomJeton = 'token'): string
    {
        return $utilisateur->createToken($nomJeton)->accessToken;
    }

    public static function generer_otp(User $utilisateur, int $minutesValidite = 10): int
    {
        $otpBrut = random_int(100000, 999999);
        $utilisateur->update([
            FieldName::OTP => Hash::make($otpBrut),
            FieldName::EXPIRE_LE => now()->addMinutes($minutesValidite),
            ]);
        return $otpBrut;
    }

    public static function regenerer_mot_de_passe(User $utilisateur): string
    {
        $motDePasseClair = Str::password(8, letters: true, numbers: true, symbols: true);

        $utilisateur->update([
            FieldName::PASSWORD => Hash::make($motDePasseClair),
            FieldName::OTP => null,
            FieldName::EXPIRE_LE => null,
            FieldName::EMAIL_VERIFIE_LE => now(),
        ]);
        return $motDePasseClair;
    }


    public static function filtrer(Builder $query, array $configuration = [], array $optionsTri = []): Builder
    {
        $request = request();
        $filtrerParRelationVisite = method_exists($query->getModel(), 'visite');
        if (in_array(FieldName::DATE_VISITE, $configuration)) {
            if ($request->filled('date_debut') || $request->filled('date_fin')) {
                $dateDebut = $request->input('date_debut');
                $dateFin = $request->input('date_fin');

                $appliquerFiltreDate = function ($q) use ($dateDebut, $dateFin) {
                    if ($dateDebut && $dateFin) {
                        $q->whereBetween(FieldName::DATE_VISITE, [$dateDebut, $dateFin]);
                    } elseif ($dateDebut) {
                        $q->where(FieldName::DATE_VISITE, '>=', $dateDebut);
                    } elseif ($dateFin) {
                        $q->where(FieldName::DATE_VISITE, '<=', $dateFin);
                    }
                };

                if ($filtrerParRelationVisite) {
                    $query->whereHas('visite', $appliquerFiltreDate);
                } else {
                    $appliquerFiltreDate($query);
                }
            }
        }
        if (in_array(FieldName::SITE_ID, $configuration) && $request->filled('site_id')) {
            $siteId = $request->input('site_id');
            $appliquerFiltreSite = function ($q) use ($siteId) {
                $q->where(FieldName::SITE_ID, $siteId);
            };

            if ($filtrerParRelationVisite) {
                $query->whereHas('visite', $appliquerFiltreSite);
            } else {
                $appliquerFiltreSite($query);
            }
        }
        foreach ($configuration as $champ) {
            if ($champ === FieldName::DATE_VISITE || $champ === FieldName::SITE_ID) {
                continue;
            }

            $champMinuscule = Str::lower($champ);
            if (Str::contains($champMinuscule, 'date') || Str::endsWith($champMinuscule, '_at')) {
                
                $dateDebut = $request->input('date_debut');
                $dateFin = $request->input('date_fin');

                if ($request->filled('date_debut') && $request->filled('date_fin')) {
                    $query->whereBetween($champ, [$dateDebut, $dateFin]);
                } elseif ($request->filled('date_debut')) {
                    $query->where($champ, '>=', $dateDebut);
                } elseif ($request->filled('date_fin')) {
                    $query->where($champ, '<=', $dateFin);
                }
                continue; 
            }

            if ($request->filled($champ)) {
                $valeur = $request->input($champ);
                if ($valeur === 'all') {
                    continue;
                }
                if (is_numeric($valeur) || $valeur === 'true' || $valeur === 'false') {
                    $query->where($champ, $valeur);
                } else {
                    if (str_contains($valeur, '*')) {
                        $valeurNettoyee = str_replace('*', '%', $valeur);
                        $query->where($champ, 'ilike', $valeurNettoyee);
                    } else {
                        $query->where($champ, 'ilike', '%' . $valeur . '%');
                    }
                }
            }
        }
        if ($request->filled('sort')) {
            $sort = $request->input('sort');

            $colonneCandidate = null;
            $direction = null;
            if (Str::endsWith($sort, '_az')) {
                $colonneCandidate = Str::beforeLast($sort, '_az');
                $direction = 'asc';
            } elseif (Str::endsWith($sort, '_za')) {
                $colonneCandidate = Str::beforeLast($sort, '_za');
                $direction = 'desc';
            }

            if ($colonneCandidate && in_array($colonneCandidate, $optionsTri)) {
                $query->orderBy($colonneCandidate, $direction);
            }
        } else {
            $query->latest(); 
        }
        return $query;
    }
}