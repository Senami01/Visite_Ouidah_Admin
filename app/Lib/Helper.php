<?php

use App\Models\User;
use App\Lib\FieldName;
use Illuminate\Support\Facades\Hash;

if (! function_exists('generer_jeton_connexion')) {
    
    function generer_jeton_connexion(User $utilisateur, string $nomJeton = 'token'): string
    {
        return $utilisateur->createToken($nomJeton)->accessToken;
    }
}

if (! function_exists('generer_otp')) {

    function generer_otp(User $utilisateur, int $minutesValidite = 10): int
    {
        $otpBrut = random_int(100000, 999999);

        $utilisateur->update([
            FieldName::OTP => Hash::make($otpBrut),
            FieldName::EXPIRE_LE => now()->addMinutes($minutesValidite),
        ]);
        return $otpBrut;
    }
}

if (! function_exists('reinitialiser_mot_de_passe')) {
    function reinitialiser_mot_de_passe(User $utilisateur, string $nouveauMotDePasse): bool
    {
        return $utilisateur->update([
            FieldName::PASSWORD => Hash::make($nouveauMotDePasse),
            FieldName::OTP => null,
            FieldName::EXPIRE_LE => null,
            FieldName::EMAIL_VERIFIE_LE => now(),
        ]);
    }
}

if (! function_exists('regenerer_mot_de_passe')) {
    function regenerer_mot_de_passe(User $utilisateur): string
    {
        $majuscule = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $minuscule = 'abcdefghijklmnopqrstuvwxyz';
        $chiffre = '0123456789';
        $special = '@#$';

        $pass[] = $majuscule[rand(0, strlen($majuscule) - 1)];
        $pass[] = $minuscule[rand(0, strlen($minuscule) - 1)];
        $pass[] = $chiffre[rand(0, strlen($chiffre) - 1)];
        $pass[] = $special[rand(0, strlen($special) - 1)];

        $Caracteres = $majuscule . $minuscule . $chiffre . $special;
        for ($i = 0; $i < 4; $i++) {
            $pass[] = $Caracteres[rand(0, strlen($Caracteres) - 1)];
        }

        shuffle($pass);
        $motDePasseClair = implode('', $pass);

        $utilisateur->update([
            FieldName::PASSWORD => Hash::make($motDePasseClair),
            FieldName::OTP => null,
            FieldName::EXPIRE_LE => null,
            FieldName::EMAIL_VERIFIE_LE => now(),
        ]);

        return $motDePasseClair;
    }
}