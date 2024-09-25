<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Imports\QuestionImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportQuestionController extends Controller
{
    public function show(){
        return View::make('questions.import');
    }
    public function import(){

        // Excel::import(new QuestionImport, request()->file('fichier'));
        Excel::import(new QuestionImport, request()->file('fichier'));
        // dd('ici', request()->all());
        return back()->with('success','Enregistrement reussi avec succès');
    }
}
