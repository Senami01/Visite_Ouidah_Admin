<?php

namespace App\Http\Controllers\Authentification;

use App\Lib\FieldName;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController\BaseController;
use Illuminate\Http\Request;

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

        $jeton = generer_jeton_connexion($utilisateur);
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

        $otp = generer_otp($utilisateur);

        return $this->sendResponse(['otp_test' => $otp],'Si vous avez un compte avec cet e-mail, un code de vérification à 6 chiffres vous a été envoyé.');
    }

    public function verifierOtp(Request $request)
    {
        $champs = $request->validate([
            FieldName::EMAIL => 'required|email',
            FieldName::OTP => 'required|numeric',
        ]);

        $utilisateur = User::where(FieldName::EMAIL, $champs[FieldName::EMAIL])->first();

        if (!$utilisateur->{FieldName::EXPIRE_LE} || now()->isAfter($utilisateur->{FieldName::EXPIRE_LE}) || 
            !Hash::check($champs[FieldName::OTP], $utilisateur->{FieldName::OTP})) {
            return $this->sendError('Code de vérification invalide ou expiré.', [], 422);
        }

        return $this->sendResponse([],'Code de vérification valide. Vous pouvez réinitialiser votre mot de passe.');
    }


    public function reinitialiserMotDePasse(Request $request)
    {
        $champs = $request->validate([
            FieldName::EMAIL => 'required|email',
            FieldName::PASSWORD => 'required|string|min:8|confirmed',
        ]);

        $utilisateur = User::where(FieldName::EMAIL, $champs[FieldName::EMAIL])->first();

        if (!$utilisateur->{FieldName::EXPIRE_LE} || now()->isAfter($utilisateur->{FieldName::EXPIRE_LE})) {
            return $this->sendError('Action non autorisée ou code de vérification expiré.', [], 422);
        }

       reinitialiser_mot_de_passe($utilisateur, $champs[FieldName::PASSWORD]);

        return $this->sendResponse([],'Votre mot de passe a été modifié avec succès.');
    }

}
