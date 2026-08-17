<?php

use App\Lib\Endpoint;
use App\Http\Controllers\Administration\UsersController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/' . Endpoint::ADMINISTRATEURS, UsersController::class);