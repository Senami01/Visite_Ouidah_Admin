<?php

use App\Lib\Endpoint;
use App\Http\Controllers\Authentification\AuthentificationController;
use Illuminate\Support\Facades\Route;

Route::post('/' . Endpoint::CONNEXION, [AuthentificationController::class, 'connexion']);
Route::post('/' . Endpoint::MOT_DE_PASSE_OUBLIE, [AuthentificationController::class, 'envoyerOtp']);
Route::post('/' . Endpoint::VERIFIER_OTP, [AuthentificationController::class, 'verifierOtp']);
Route::post('/' . Endpoint::REINITIALISER_MOT_DE_PASSE, [AuthentificationController::class, 'reinitialiserMotDePasse']);

