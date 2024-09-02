<?php

namespace App\Http\Controllers\Api;

use App\Models\Jury;
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

                $votes = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('phase_jury_id', $juryId)->where('phase_critere_id', $criterePhaseId)->get();
                if ($votes) {
                    foreach ($votes as $vote) {
                        $vote->update([
                            'isVerified' => 1
                        ]);
                    }
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function sendVoteByCandidat(Request $request)
    {
        $voteData = $request->all();
        $authorization = str_replace('Bearer ', '', $request->header('Authorization'));
        $jury = Jury::where('token', $authorization)->first();

        $phaseId = $voteData['phase_id'];
        $juryId = $jury->id;
        $candidatId = $voteData['intervenant_id'];
        $cotes = $voteData['cote'];
        $nombreUser = $voteData['nombre_user'];

        $intervenantPhase = IntervenantPhase::where('intervenant_id', $candidatId)->where('phase_id', $phaseId)->first();
        if(!$intervenantPhase)
        {
            return response()->json(['status' => 'unsuccess'], 400);
        }
        $intervenantPhaseIds = $intervenantPhase->id;

        $votes = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('jury_phase_id', $juryId)->where('nombre', $nombreUser)->get();
        if ($votes) {
            foreach ($votes as $vote) {
                $vote->delete();
            }
        }

        foreach ($cotes as $cote) {
            $critereId = $cote['critere_id'];
            $coteValue = $cote['valeur'];

            $criterePhase = PhaseCritere::where('critere_id', $critereId)->where('phase_id', $phaseId)->first();
            $criterePhaseId = $criterePhase->id;

            $vote = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('jury_phase_id', $juryId)->where('phase_critere_id', $criterePhaseId)->first();

            if ($vote) {
                $jury = Jury::where('id', $juryId)->first();
                $typeJury = $jury->type;

                if ($typeJury == 'public') {
                    $addVote = new Vote();
                    $addVote->intervenant_phase_id = $intervenantPhaseIds;
                    $addVote->jury_phase_id = $juryId;
                    $addVote->phase_critere_id = $criterePhaseId;
                    $addVote->cote = $coteValue;
                    $addVote->nombre = $nombreUser;
                    $addVote->save();
                }
            } else {
                Vote::create([
                    'intervenant_phase_id' => $intervenantPhaseIds,
                    'jury_phase_id' => $juryId,
                    'phase_critere_id' => $criterePhaseId,
                    'cote' => $coteValue,
                    'nombre' => $nombreUser,
                ]);
            }
        }
        return response()->json(['status' => 'success'], 200);
    }
}
