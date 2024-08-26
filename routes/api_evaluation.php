<?php

use App\Http\Controllers\Api\PhaseController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionPhaseController;
use App\Http\Controllers\Api\ReponseController;
use Illuminate\Support\Facades\Route;

// Route::get('/phases', [PhaseController::class ,'index']);
 Route::apiResource('/phases', PhaseController::class, ['as'=> 'api']);
 Route::apiResource('/questions', QuestionController::class, ['as'=> 'api']);
 Route::apiResource('/question_phase', QuestionController::class, ['as'=> 'api']);
 Route::apiResource('/reponses', ReponseController::class, ['as'=> 'api']);
 Route::get('question_phases/{phase_id}/{intervenant_id}', [QuestionPhaseController::class,'shows'])->name('question_phases');