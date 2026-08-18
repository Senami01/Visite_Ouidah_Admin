<?php

namespace App\Http\Controllers\Authentification;

use App\Lib\FieldName;
use App\Models\User;
use App\Lib\Helper;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController\BaseController;
use Illuminate\Http\Request;
use App\Jobs\EnvoiMailOtpJob;
use Illuminate\Validation\ValidationException;

class AuthentificationController extends BaseController
{
    public function connexion(Request $request)
    {
        $champs = $request->validate([
            FieldName::EMAIL => 'required|email',
            FieldName::PASSWORD => 'required|string',
        ]);

        $utilisateur = User::where(FieldName::EMAIL, $champs[FieldName::EMAIL])->first();

        if (!$utilisateur || !Hash::check($champs[FieldName::PASSWORD], $utilisateur->{FieldName::PASSWORD})) {
            return $this->sendError('Identifiants invalides', [], 401);
        }

        $utilisateur->update([
            FieldName::DERNIERE_CONNEXION => now()
        ]);

        $jeton = Helper::generer_jeton_connexion($utilisateur);
        $donnees = [
            'utilisateur' => $utilisateur,
            'token' => $jeton
        ];
        return $this->sendResponse($donnees, "Connexion réussie.");
    }

    public function envoyerOtp(Request $request)
    {
        $request->validate([
            FieldName::EMAIL => 'required|email'
        ]);

        $utilisateur = User::where(FieldName::EMAIL, $request->input(FieldName::EMAIL))->first();

        if (!$utilisateur) {
            return $this->sendResponse([],'Si vous avez un compte avec cet e-mail, un code de vérification à 6 chiffres vous a été envoyé.');
        }

        $otp = Helper::generer_otp($utilisateur);
        EnvoiMailOtpJob::dispatch($utilisateur, $otp);
        return $this->sendResponse([],'Si vous avez un compte avec cet e-mail, un code de vérification à 6 chiffres vous a été envoyé.');
    }

    public function verifierOtp(Request $request)
    {
        try {
            $champs = $request->validate([
                FieldName::EMAIL => 'required|email',
                FieldName::OTP => 'required|numeric|digits:6',
            ],
            [
                FieldName::EMAIL . '.required' => 'L\'adresse email est obligatoire.',
                FieldName::EMAIL . '.email' => 'L\'adresse email doit être valide.',
                FieldName::OTP . '.required' => 'Le code de vérification est obligatoire.',
                FieldName::OTP . '.numeric' => 'Le code de vérification doit être un nombre.',
                FieldName::OTP . '.digits' => 'Le code de vérification doit contenir exactement 6 chiffres.',
            ]);

            $utilisateur = User::where(FieldName::EMAIL, $champs[FieldName::EMAIL])->first();

            if (!$utilisateur->{FieldName::EXPIRE_LE} || now()->isAfter($utilisateur->{FieldName::EXPIRE_LE}) || 
                !Hash::check($champs[FieldName::OTP], $utilisateur->{FieldName::OTP})) {
                return $this->sendError('Code de vérification invalide ou expiré.', [], 422);
            }
            return $this->sendResponse([],'Code de vérification valide. Vous pouvez réinitialiser votre mot de passe.');
        } catch (ValidationException $e) {
            return $this->sendError('Erreur de validation', $e->errors(), 422);
        }
    }

    public function reinitialiserMotDePasse(Request $request)
    {
        try {
            $champs = $request->validate([
                FieldName::EMAIL => 'required|email',
                FieldName::PASSWORD => ['required','string','confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/'],
            ], [
                FieldName::EMAIL . '.required' => 'L\'adresse email est obligatoire.',
                FieldName::EMAIL . '.email' => 'L\'adresse email doit être valide.',
                FieldName::PASSWORD . '.required' => 'Le mot de passe est obligatoire.',
                FieldName::PASSWORD . '.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
                FieldName::PASSWORD . '.regex' => 'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial (@$!%*?&).',
            ]);

            $utilisateur = User::where(FieldName::EMAIL, $champs[FieldName::EMAIL])->first();

            if (!$utilisateur->{FieldName::EXPIRE_LE} || now()->isAfter($utilisateur->{FieldName::EXPIRE_LE})) {
                return $this->sendError('Action non autorisée ou code de vérification expiré.', [], 422);
            }

            $utilisateur->update([
                FieldName::PASSWORD => Hash::make($champs[FieldName::PASSWORD]),
                FieldName::OTP => null,
                FieldName::EXPIRE_LE => null,
                FieldName::EMAIL_VERIFIE_LE => now(),
            ]);
            return $this->sendResponse([],'Votre mot de passe a été modifié avec succès.');
        }catch (ValidationException $e) {
            return $this->sendError('Erreur de validation',$e->errors(),422);
        }
    }

}
