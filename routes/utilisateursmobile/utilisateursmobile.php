<?php

use App\Lib\Endpoint;
use App\Http\Controllers\UtilisateursMobile\UtilisateursMobileController;
use Illuminate\Support\Facades\Route;

Route::get('/' . Endpoint::UTILISATEURS_MOBILE, [UtilisateursMobileController::class, 'index']);
Route::post('/' . Endpoint::UTILISATEURS_MOBILE, [UtilisateursMobileController::class, 'store']);
