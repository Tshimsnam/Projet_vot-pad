<?php

use App\Http\Controllers\Api\PhaseController;
use Illuminate\Support\Facades\Route;
use App\Models\Phase;

Route::get('/phases', [PhaseController::class ,'index']);
// Route::apiResource('phases', Phase::class, ['as'=> 'api']);

