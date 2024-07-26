<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;


// Route::prefix('vote')->group(function () {
//     Route::get('/acceuil',[VoteController::class,'index']);
// });

Route::prefix('vote')->group(function () {
    Route::get('/events/{evenement}', [VoteController::class,'index']);
    Route::get('/event/{phase}', [VoteController::class,'show'])->name('show');
    Route::get('event/{phase}/{candidat}{jury}', [VoteController::class,'showIntervenant'])->name('showIntervenant');
});