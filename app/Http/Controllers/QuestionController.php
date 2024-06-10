<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->get();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create([
            'question'=> $request->question,
            'ponderation'=> $request->ponderation,
            'statut'=> $request->statut,
            'phase_id'=> $request->phase_id,
        ]);
        return redirect()->route('questions.index')->with('success','question enregistrée avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $questionShow=$question;
        return view('questions.show', compact('questionShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
       $questionEdit=$question;
       return view('questions.edit', compact('questionEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update([
            'ponderation'=>$request->ponderation,
            'statut'=>$request->statut
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //desactivation de statut et on va creer une vue pour les questions supprimees
    }
}
