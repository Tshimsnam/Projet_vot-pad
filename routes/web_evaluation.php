<?php

use App\Http\Controllers\AssertionController;
use App\Http\Controllers\ImportQuestionController;
use App\Http\Controllers\IntervenantController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionPhaseController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\ResultatController;
use App\Http\Middleware\IntervenantMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::get('phase/create/{evenement_id}', [PhaseController::class, 'create'])->name('phase.create');
    Route::get('phase/{id}', [PhaseController::class,'evenementPhase'])->name('phase.show');
    Route::get('phase_question_detatil/{id}', [PhaseController::class,'phaseQuestionDetail'])->name('phase_question_detatil');
    
    Route::delete('question-delete-all/{id}', [QuestionController::class,'deleteQuestion'])->name('DeleteQuestion');
    Route::post('auto-question-get', [QuestionController::class,'getQuestionAuto'])->name('auto-question-get');

    Route::get('phase/encours', [PhaseController::class,'encours'])->name('phase.encours');
    Route::get('phase/active', [PhaseController::class,'active'])->name('phase.active');
    Route::get('phase/desactive', [PhaseController::class,'desactive'])->name('phase.desactive');
    
    Route::get('phase/attente', [PhaseController::class,'enAttente'])->name('phase.attente');
    Route::get('phase/pause', [PhaseController::class,'pause'])->name('phase.pause');
    Route::get('phase/terminer', [PhaseController::class,'terminer'])->name('phase.terminer');
    
    

    Route::post('import_question',[ImportQuestionController::class,"import"])->name("importQuestion");
    Route::get('resultats_detail/{phase_id}/{interv_id}',[ResultatController::class,"resultatDetail"])->name("restultatDetatil");
   
    Route::resource('phases', PhaseController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('assertions', AssertionController::class);
    Route::resource('questionPhases', QuestionPhaseController::class);
    Route::resource('resultats', ResultatController::class);

    

   
});
Route::get('response-test', function (){
    return view('reponses.response');
});
Route::get('intervenant-logout',[IntervenantController::class, 'logout'])->name('inter.logout')->middleware('is_login');
Route::resource('reponses', ReponseController::class);//->middleware("is_login");
Route::get("questions_phase",[QuestionPhaseController::class,"questionPhase"])->name("phasequestion");//->middleware('is_login');
Route::post('cloture-evaluation',[PhaseController::class, 'closePhase'])->name('close.phase');
Route::get('lancer-evaluation/{id}',[PhaseController::class, 'lancerPhase'])->name('open.phase');
Route::get('details-question/{id}/{phase_id}',[PhaseController::class, 'detailQuestion'])->name('question.phase');
Route::post('update-question',[PhaseController::class, 'updateQuestion'])->name('question.update');
Route::get('send-mail/{phase_id}',[PhaseController::class, 'sendMail'])->name('mail.view');
require __DIR__.'/auth.php';
