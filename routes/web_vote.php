<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\PhaseController;
use App\Http\Middleware\JuryTokenIsValid;



// Route::prefix('vote')->group(function () {
//     Route::get('/acceuil',[VoteController::class,'index']);
// });

Route::prefix('vote')->group(function () {
    Route::get('/events', [VoteController::class,'index'])->name('voteIndex');
    Route::get('/event/{phase}', [VoteController::class,'show'])->name('show')->middleware(JuryTokenIsValid::class);
    Route::get('event/{phase}/{candidat}/{jury}/{nombreUser}/{evenement}', [VoteController::class,'showIntervenant'])->name('showIntervenant')->middleware(JuryTokenIsValid::class);
});

Route::get('/results/{phase}', [VoteController::class,'results'])->name('results');

Route::post('passation', [PhaseController::class, 'passation'])->name('passation');
