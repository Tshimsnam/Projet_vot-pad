<?php

use App\Http\Controllers\EntretienController;
use App\Mail\CandidatMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuryController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PhaseController;
use App\Http\Middleware\JuryTokenIsValid;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\VoteExcelController;
use App\Http\Controllers\IntervenantController;
use App\Http\Controllers\EvaluationExcelController;
use App\Http\Controllers\IntervenantPhaseController;


Route::middleware('auth')->group(function () {
    Route::resource('evenements', EvenementController::class)->names([
        'index' => 'evenements.index',
        'create' => 'evenements.create',
        'store' => 'evenements.store',
        'show' => 'evenements.show',
        'edit' => 'evenements.edit',
        'update' => 'evenements.update',
        'destroy' => 'evenements.destroy',
    ]);
    Route::resource('criteres', CritereController::class);
    Route::resource('intervenants', IntervenantController::class);
    Route::resource('jurys', JuryController::class);
    Route::delete('/jurys/{jury}/{phaseId}', [JuryController::class, 'destroy'])->name('jury.destroy');
    Route::delete('/intervenants/{intervenant}/{phaseId}', [IntervenantController::class, 'destroy'])->name('intervenant.destroy');
    Route::put('/phases/{id}/{status}', [PhaseController::class, 'changeStatus'])->name('phases.status');
    Route::get('/qrcodes/{jurys}/{nombre}', [QRCodeController::class, 'index'])->name('qrcodes');

    Route::resource('entretiens', EntretienController::class);
});

Route::get('/votePad-form', [IntervenantController::class, 'form'])->name('form-authenticate');
Route::post('/votePad/evaluation', [IntervenantController::class, 'authenticate'])->name('authenticate');

Route::get('/Del_votePad', [JuryController::class, 'form'])->name('jury-form');
Route::post('/votePad/voting', [VoteController::class, 'authenticate'])->name('jury-authenticate');
Route::get('/votePad/voting/success/{phase_id}/{jury_id}/{candidats}/{criteres}/{nombreUser}/{evenement}', [VoteController::class, 'show'])->name('jury.success')->middleware(JuryTokenIsValid::class);;

Route::post('/sendmail',  [IntervenantPhaseController::class, 'sendMail'])->name('sendMail');
Route::post('/sendsmails',  [IntervenantPhaseController::class, 'sendMailMany'])->name('sendMailMany');
Route::get('/intro', [IntervenantPhaseController::class, 'intro']);

Route::get('/vote-excel/{phase_id}', [VoteExcelController::class, 'export_excel'])->name('export_vote');
Route::get('/evaluation-excel/{phase_id}', [EvaluationExcelController::class, 'export_excel'])->name('export_evaluation');

Route::get('/question_format', function () {
    $filePath = public_path('fichiers/format_question.xlsx');
    return Response::download($filePath, 'format_question.xlsx');
})->name('question_format');

Route::get('/candidat_format', function () {
    $filePath = public_path('fichiers/format_candidat.xlsx');
    return Response::download($filePath, 'format_candidat.xlsx');
})->name('candidat_format');

Route::post('/creationStep', [EvenementController::class, 'creationStep'])->name('creationStep');