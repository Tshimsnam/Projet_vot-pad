<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Phase;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\Evenement;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($event)
    {
        $phases=null;
        $eventId = $event;
        $event= Evenement::where('id',$eventId)->first();
        if ($event) {
           $phases = $event->phases;
        }
        return view("votes.index",compact('phases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $vote)
    {
       $phase_id= Phase::where('slug',$vote)->first()->id;
       $phaseAndSpeaker = Phase::with('intervenants')->findOrFail($phase_id);
        // return response()->json($phaseAndSpeaker);
        return view("votes.show",compact('phaseAndSpeaker'));
    }

    public function showIntervenant($vote) {
        return view("votes.showIntervenant");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoteRequest $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
