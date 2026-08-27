<?php

use App\Lib\Endpoint;
use App\Http\Controllers\Administration\AdminController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/' . Endpoint::UTILISATEURS . '/' . Endpoint::ADMIN, AdminController::class);
Route::put('/' . Endpoint::UTILISATEURS . '/' . Endpoint::ADMIN . '/{admin}/statut', [AdminController::class, 'statut']);