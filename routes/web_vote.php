<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;


// Route::prefix('vote')->group(function () {
//     Route::get('/acceuil',[VoteController::class,'index']);
// });

Route::prefix('vote')->group(function () {
    Route::get('/', [VoteController::class,'index']);
    Route::get('/vote/{id}', [VoteController::class,'show'])->name('show');
});