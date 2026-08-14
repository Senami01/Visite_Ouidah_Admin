<?php

use App\Models\User;
use App\Lib\FieldName;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

function generer_jeton_connexion(User $utilisateur, string $nomJeton = 'token'): string
{
    return $utilisateur->createToken($nomJeton)->accessToken;
}

function generer_otp(User $utilisateur, int $minutesValidite = 10): int
{
    $otpBrut = random_int(100000, 999999);
    $utilisateur->update([
        FieldName::OTP => Hash::make($otpBrut),
        FieldName::EXPIRE_LE => now()->addMinutes($minutesValidite),
        ]);
    return $otpBrut;
}

function regenerer_mot_de_passe(User $utilisateur): string
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
