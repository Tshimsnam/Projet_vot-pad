<?php

namespace App\Http\Controllers\API;

use App\Models\Vote;
use App\Models\PhaseCritere;
use Illuminate\Http\Request;
use App\Models\IntervenantPhase;
use App\Http\Controllers\Controller;

class VoteController extends Controller
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
        $intervenant = $request->intervenantId;
        $cotes = $request->cote;
        return response()->json($intervenant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vote $vote)
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

    public function sendVote(Request $request)
    {
        $voteData = $request->input('voteData');

        $phaseId = $voteData['phaseId'];
        $juryId = $voteData['juryId'];
        $candidats = $voteData['candidats'];

        foreach ($candidats as $candidat) {
            $candidatId = $candidat['candidatId'];
            $cotes = $candidat['cote'];

            foreach ($cotes as $cote) {
                $critereId = $cote['critereId'];
                $coteValue = $cote['valeur'];

                $intervenantPhase = IntervenantPhase::where('intervenant_id', $candidatId)->where('phase_id', $phaseId)->first();
                $intervenantPhaseIds = $intervenantPhase->id;

                $criterePhase = PhaseCritere::where('critere_id', $critereId)->where('phase_id', $phaseId)->first();
                $criterePhaseId = $criterePhase->id;

                $vote = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('phase_jury_id', $juryId)->where('phase_critere_id', $criterePhaseId)->first();

                if ($vote) {
                    $vote->update([
                        'intervenant_phase_id' => $intervenantPhaseIds,
                        'phase_jury_id' => $juryId,
                        'phase_critere_id' => $criterePhaseId,
                        'cote' => $coteValue,
                        'isVerified' => 1
                    ]);
                } else {

                    Vote::create([
                        'intervenant_phase_id' => $intervenantPhaseIds,
                        'phase_jury_id' => $juryId,
                        'phase_critere_id' => $criterePhaseId,
                        'cote' => $coteValue,
                        'isVerified' => 1
                    ]);
                }
            }
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function sendVoteByCandidat(Request $request)
    {
        $voteData = $request->input('voteData');

        $phaseId = $voteData['phaseId'];
        $juryId = $voteData['juryId'];
        $candidatId = $voteData['candidatId'];
        $cotes = $voteData['cotes'];
        foreach ($cotes as $cote) {
            $critereId = $cote['critereId'];
            $coteValue = $cote['valeur'];

            $intervenantPhase = IntervenantPhase::where('intervenant_id', $candidatId)->where('phase_id', $phaseId)->first();
            $intervenantPhaseIds = $intervenantPhase->id;

            $criterePhase = PhaseCritere::where('critere_id', $critereId)->where('phase_id', $phaseId)->first();
            $criterePhaseId = $criterePhase->id;

            $vote = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('phase_jury_id', $juryId)->where('phase_critere_id', $criterePhaseId)->first();

            if ($vote) {
                $vote->update([
                    'intervenant_phase_id' => $intervenantPhaseIds,
                    'phase_jury_id' => $juryId,
                    'phase_critere_id' => $criterePhaseId,
                    'cote' => $coteValue,
                ]);
            } else {

                Vote::create([
                    'intervenant_phase_id' => $intervenantPhaseIds,
                    'phase_jury_id' => $juryId,
                    'phase_critere_id' => $criterePhaseId,
                    'cote' => $coteValue,
                ]);
            }
        }
        return response()->json(['status' => 'success'], 200);
    }
}
