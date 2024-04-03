<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GifsController;
use Illuminate\Support\Facades\Route;

//Private
Route::middleware(['auth:sanctum', 'log.api.requests'])->group(function(){
    Route::post("/search", [GifsController::class, 'search']);
    Route::post("/save", [GifsController::class, "save"]);
    Route::get("/search/{id?}", [GifsController::class, 'getById']);
});

//Public
Route::middleware('log.api.requests')->group(function(){
    Route::post("/login", [AuthController::class, "login"]);
});

Route::post("/register", [AuthController::class, "register"]);