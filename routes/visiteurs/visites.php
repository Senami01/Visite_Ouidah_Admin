<?php

use App\Lib\Endpoint;
use App\Http\Controllers\visiteurs\VisitesController;
use Illuminate\Support\Facades\Route;

Route::get('/' . Endpoint::VISITEURS . '/{id}' . '/' . Endpoint::VISITES, [VisitesController::class, 'index']);