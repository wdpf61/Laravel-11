<?php

use App\Http\Controllers\Vue\RoleController;
use App\Http\Controllers\Vue\WelcomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("test", [WelcomController::class,'index']);

Route::apiResource("roles",RoleController::class);

