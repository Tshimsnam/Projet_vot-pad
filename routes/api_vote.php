<?php

use App\Http\Controllers\Api\JuryController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Support\Facades\Route;


//Route::get('jury', [JuryController::class, 'authenticate']);
Route::apiResource('/jurys',JuryController::class, ['as'=>'api']);
Route::post('/jurys-identifiant', [JuryController::class, 'authenticate'])->name('jurys-identifiant');

Route::post('/votesFinal', [VoteController::class,'sendVote'])->name('sendVote');
Route::post('/votesUnique', [VoteController::class,'sendVoteByCandidat'])->name('sendUniqueVote');

