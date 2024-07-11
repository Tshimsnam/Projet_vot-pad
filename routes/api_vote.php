<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\JuryController;

Route::get('jury', [JuryController::class, 'authenticate']);
Route::apiResource('/jurys',JuryController::class, ['as'=>'api']);

