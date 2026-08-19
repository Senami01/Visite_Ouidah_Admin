<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sites_touristiques\Sites_TouristiquesController;
use App\Lib\Endpoint;

Route::apiResource('/' . Endpoint::SITES_TOURISTIQUES, Sites_TouristiquesController::class);
Route::patch('/' . Endpoint::SITES_TOURISTIQUES . '/{id}/desactiver', [Sites_TouristiquesController::class,
    'changementStatus'
]);