<?php

use App\Lib\Endpoint;
use App\Http\Controllers\visiteurs\VisiteursController;
use Illuminate\Support\Facades\Route;

Route::get('/' . Endpoint::VISITEURS, [VisiteursController::class, 'index']);
Route::get('/' . Endpoint::VISITEURS . '/{id}', [VisiteursController::class, 'show']);