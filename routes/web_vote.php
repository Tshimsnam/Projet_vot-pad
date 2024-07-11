<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;


// Route::prefix('vote')->group(function () {
//     Route::get('/acceuil',[VoteController::class,'index']);
// });

Route::prefix('vote')->group(function () {
    Route::get('/event/{evenement}', [VoteController::class,'index']);
    Route::get('/{id}', [VoteController::class,'show'])->name('show');
    Route::get('/candidat/{id}', [VoteController::class,'showIntervenant'])->name('showIntervenant');
});