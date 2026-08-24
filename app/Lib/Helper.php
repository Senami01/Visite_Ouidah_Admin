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
        
        foreach ($configuration as $champ) {
            if (Str::contains(Str::lower($champ), 'date') || Str::contains(Str::lower($champ), 'at')) {
                
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