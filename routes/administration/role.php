<?php

use App\Lib\Endpoint;
use App\Http\Controllers\Administration\RoleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/' . Endpoint::ROLES, RoleController::class);