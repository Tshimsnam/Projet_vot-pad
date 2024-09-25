<?php

namespace App\Http\Controllers\Api;

use App\Models\Jury;
use App\Models\Vote;
use App\Models\Intervenant;
use Illuminate\Http\Request;
use App\Models\IntervenantPhase;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntervenantPhaseResource;

class IntervenantPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $phaseId)
    {
        $authorizationHeader = $request->header('Authorization');
        $authorizationHeader = $request->header('Authorization');

        if (preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
            $token = $matches[1];
        } 

        $jury = Jury::where('token', $token)->first();

        $intervenantPhases = IntervenantPhase::where('phase_id', $phaseId)->get();
        $intervenants = [];
        foreach ($intervenantPhases as $intervenantPhase) {
            $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
            $intervenant->intervenantPhaseId = $intervenantPhase->id;
            $exist = Vote::where('jury_phase_id', $jury->id)->where('intervenant_phase_id', $intervenantPhase->id)->exists();
            if($exist){
                $intervenant->isDone = true;
            }else{
                $intervenant->isDone = false;
            }
            $intervenant->phaseId = (int) $phaseId;
            $intervenants[] = $intervenant;
        }

        return IntervenantPhaseResource::collection($intervenants);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IntervenantPhase $intervenantPhase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntervenantPhase $intervenantPhase)
    {
        //
    }
}
