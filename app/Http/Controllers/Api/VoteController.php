<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Intervenant;
use App\Models\IntervenantPhase;
use App\Models\Jury;
use App\Models\PhaseCritere;
use App\Models\Vote;
use Illuminate\Http\Request;

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
        $cotes       = $request->cote;
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

        $phaseId   = $voteData['phaseId'];
        $juryId    = $voteData['juryId'];
        $candidats = $voteData['candidats'];

        foreach ($candidats as $candidat) {
            $candidatId = $candidat['candidatId'];
            $cotes      = $candidat['cote'];

            foreach ($cotes as $cote) {
                $critereId = $cote['critereId'];
                $coteValue = $cote['valeur'];

                $intervenantPhase    = IntervenantPhase::where('intervenant_id', $candidatId)->where('phase_id', $phaseId)->first();
                $intervenantPhaseIds = $intervenantPhase->id;

                $criterePhase   = PhaseCritere::where('critere_id', $critereId)->where('phase_id', $phaseId)->first();
                $criterePhaseId = $criterePhase->id;

                $votes = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('phase_jury_id', $juryId)->where('phase_critere_id', $criterePhaseId)->get();
                if ($votes) {
                    foreach ($votes as $vote) {
                        $vote->update([
                            'isVerified' => 1,
                        ]);
                    }
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function sendVoteByCandidat(Request $request)
    {
        $voteData      = $request->all();
        $authorization = str_replace('Bearer ', '', $request->header('Authorization'));
        $jury          = Jury::where('token', $authorization)->first();

        $phaseId       = $voteData['phase_id'];
        $juryId        = $jury->id;
        $candidatId    = $voteData['intervenant_id'];
        $cotes         = $voteData['cote'];
        $nombreUser    = $voteData['nombre_user'];
        $age           = null;
        $sexe          = null;
        $statut        = null;
        $etablissement = null;
        $promotion     = null;
        $decision      = null;
        $autre         = null;

        if ($jury->type == 'entretien') {
            $age           = $voteData['age'];
            $sexe          = $voteData['sexe'];
            $statut        = $voteData['statut'];
            $etablissement = $voteData['etablissement'];
            $promotion     = $voteData['promotion'];
            $decision      = $voteData['decision'];
            $autre         = $voteData['autre'];
        }

        $intervenantPhase = IntervenantPhase::where('intervenant_id', $candidatId)->where('phase_id', $phaseId)->first();
        if (! $intervenantPhase) {
            return response()->json(['status' => 'unsuccess'], 400);
        }
        $intervenantPhaseIds = $intervenantPhase->id;

        $intervenant = Intervenant::where('id', $candidatId)->first();
        $statutCand  = "";
        if ($intervenant) {
            if ($statut == 'autre') {
                $statutCand = $autre;
            } else {
                $statutCand = $statut;
            }
            $intervenant->age        = $age;
            $intervenant->genre      = $sexe;
            $intervenant->statut     = $statutCand;
            $intervenant->universite = $etablissement;
            $intervenant->promotion  = $promotion;
            $intervenant->save();
        }

        $votes = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('jury_phase_id', $juryId)->where('nombre', $nombreUser)->get();
        if ($votes) {
            foreach ($votes as $vote) {
                $vote->delete();
            }
        }
        $jury     = Jury::where('id', $juryId)->first();
        $typeJury = $jury->type;
        foreach ($cotes as $cote) {
            $critereId = $cote['critere_id'];
            $coteValue = $cote['valeur'];
            if (strtolower($typeJury) === 'entretien') {
                $commentaire = $cote['commentaire'];
            }

            $criterePhase   = PhaseCritere::where('critere_id', $critereId)->where('phase_id', $phaseId)->first();
            $criterePhaseId = $criterePhase->id;

            $vote = Vote::where('intervenant_phase_id', $intervenantPhaseIds)->where('jury_phase_id', $juryId)->where('phase_critere_id', $criterePhaseId)->first();

            if ($vote) {
                if ($typeJury == 'public') {
                    $addVote                       = new Vote();
                    $addVote->intervenant_phase_id = $intervenantPhaseIds;
                    $addVote->jury_phase_id        = $juryId;
                    $addVote->phase_critere_id     = $criterePhaseId;
                    $addVote->cote                 = $coteValue;
                    $addVote->nombre               = $nombreUser;
                    $addVote->save();
                } else if ($typeJury == 'entretien') {
                    $addVote                       = new Vote();
                    $addVote->intervenant_phase_id = $intervenantPhaseIds;
                    $addVote->jury_phase_id        = $juryId;
                    $addVote->phase_critere_id     = $criterePhaseId;
                    $addVote->cote                 = $coteValue;
                    $addVote->nombre               = $nombreUser;
                    $addVote->commentaires         = $commentaire;
                    $addVote->decision             = $decision;
                    $addVote->save();
                }
            } else {
                if ($typeJury == 'entretien') {
                    $voteSend = Vote::create([
                        'intervenant_phase_id' => $intervenantPhaseIds,
                        'jury_phase_id'        => $juryId,
                        'phase_critere_id'     => $criterePhaseId,
                        'cote'                 => $coteValue,
                        'nombre'               => $nombreUser,
                    ]);

                    $voteSend->commentaires = $commentaire;
                    $voteSend->decision     = $decision;
                    $voteSend->save();
                } else {
                    $voteSend = Vote::create([
                        'intervenant_phase_id' => $intervenantPhaseIds,
                        'jury_phase_id'        => $juryId,
                        'phase_critere_id'     => $criterePhaseId,
                        'cote'                 => $coteValue,
                        'nombre'               => $nombreUser,
                    ]);
                }
            }
        }
        return response()->json(['status' => 'success'], 200);
    }
}
