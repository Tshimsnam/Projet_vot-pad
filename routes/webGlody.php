<?php

use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('evenements',EvenementController::class);
});