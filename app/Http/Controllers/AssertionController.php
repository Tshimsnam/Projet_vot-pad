<?php

namespace App\Http\Controllers;

use App\Models\Assertion;
use App\Http\Requests\StoreAssertionRequest;
use App\Http\Requests\UpdateAssertionRequest;

class AssertionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assertion = Assertion::latest()->get();
        return view("assertions.index", compact("assertion"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("assertions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssertionRequest $request)
    {
        $request->validated([
            'ponderation'=> 'require',
            'libele'=> 'require'
        ]);
        $assertion = Assertion::create(
            [
                'assertion'=> $request->libele,
                'ponderation'=> $request->ponderation,
                'question_id'=> $request->question_id,
            ]
        );
        return redirect()->route('assertions.index')->with('success','Enregistrement reussit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assertion $assertion)
    {
        $assertionShow=$assertion;
        return view('assertions.show', compact('assertionShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assertion $assertion)
    {
        $assertionEdit=$assertion;
        return view('assertions.edit', compact('assertionEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssertionRequest $request, Assertion $assertion)
    {
        $assertion->update([
            'assertion'=> $request->libele,
            'ponderation'=> $request->ponderation,
            'statut'=> $request->statut,
        ]);
        return redirect()->route('assertions.index')->with('success','Modification effectuée avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assertion $assertion)
    {
        //
    }
}
