<?php

use App\Lib\Endpoint;
use App\Http\Controllers\Epasses\EpassesController;
use Illuminate\Support\Facades\Route;

Route::get('/' . Endpoint::EPASSES, [EpassesController::class, 'index']);
Route::get('/' . Endpoint::EPASSES . '/{id}', [EpassesController::class, 'show']);