<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuryController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\IntervenantController;

Route::middleware('auth')->group(function () {
    Route::resource('evenements',EvenementController::class);
    Route::resource('criteres',CritereController::class);
    Route::resource('intervenants',IntervenantController::class);
    Route::resource('jurys',JuryController::class);
    Route::delete('/jurys/{jury}/{phaseId}', [JuryController::class, 'destroy'])->name('jury.destroy');
    Route::delete('/intervenants/{intervenant}/{phaseId}', [IntervenantController::class, 'destroy'])->name('intervenant.destroy');
    Route::put('/phases/{id}/{status}', [PhaseController::class, 'changeStatus'])->name('phases.status');
});

Route::get('/intervenants-form', [IntervenantController::class, 'form'])->name('form-authenticate');
Route::post('/intervenants-authenticate', [IntervenantController::class, 'authenticate'])->name('authenticate');

