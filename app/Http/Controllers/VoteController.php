<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Vote;
use App\Models\Phase;
use App\Models\Groupe;
use App\Models\Critere;
use App\Models\Evenement;
use App\Models\Intervenant;
use App\Models\PhaseCritere;
use Illuminate\Http\Request;
use App\Models\IntervenantPhase;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Models\JuryPhase;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_COOKIE['juryToken'])) {
            setcookie('juryToken', '', time() - 3600, '/');
        }

        return view("votes.index");
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
    public function show($phase_id, $jury_id, $candidats, $criteres, $nombreUser, $evenement_id)
    {
        $phaseAndSpeaker = Phase::with('intervenants')->find($phase_id);
        $evenement = Evenement::find($evenement_id);
        $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
        $intervenants = [];
        foreach ($intervenantPhases as $intervenantPhase) {
            $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
            $groupe = Groupe::find($intervenant->groupe_id);
            $intervenant->intervenantPhaseId = $intervenantPhase->id;
            $intervenants[] = $intervenant;
        }

        usort($intervenants, function ($a, $b) {
            return strcmp($a->noms, $b->noms);
        });
        return view('votes.show', compact('phaseAndSpeaker', 'phase_id', 'candidats', 'jury_id', 'criteres', 'intervenants', 'nombreUser', 'evenement'));
    }


    public function showIntervenant($slugPhase, $candidat_id, $jury_id, $nombreUser, $evenement)
    {
        $phase = Phase::where('slug', $slugPhase)->first();
        $phase_id = $phase->id;
        $phaseCriteres = PhaseCritere::where('phase_id', $phase_id)->get();
        $criteres = [];
        foreach ($phaseCriteres as $phaseCritere) {
            $critere = Critere::find($phaseCritere->critere_id);
            $critere->criterePhaseId = $phaseCritere->id;
            $critere->echelle = $phaseCritere->echelle;
            $critere->phase_id = $phase_id;
            $criteres[] = $critere;
        }
        usort($criteres, function ($a, $b) {
            return $a->id - $b->id;
        });
        $candidat = Intervenant::findOrFail($candidat_id);
        $groupe = Groupe::find($candidat->groupe_id);
        $jury = Jury::findOrFail($jury_id);
        $juryToken = $jury->token;
        return view("votes.showIntervenant", compact('criteres', 'phase_id', 'candidat_id', 'candidat', 'jury_id', 'juryToken', 'nombreUser', 'evenement'));
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

    public function authenticate(Request $request)
    {

        if (!$request->has('coupon') && !$request->hasCookie('juryToken')) {
            return redirect(route('form-authenticate'))->with('unsuccessJury', 'Veuillez vous authentifier.');
        }

        $request->validate([
            'coupon' => 'required|string',
        ]);

        $coupon = $request->coupon;
        $jury = Jury::where('coupon', $coupon)->first();

        if ($jury) {
            $juryCoupon = $jury->coupon;
            $phaseSlug = substr($juryCoupon, 0, 3);
            $phase = Phase::where('slug', $phaseSlug)->first();

            $statutPhase = $phase->statut;
            if ($statutPhase != "En cours") {
                return redirect(route('form-authenticate'))->with('unsuccessJury', 'Desolé, vous ne pouvez pas accéder au vote maintenant.');
            }

            $phase_id = $phase->id;
            $criterePhases = PhaseCritere::where('phase_id', $phase_id)->get();
            $criteres = $criterePhases->pluck('critere_id')->sort()->values();
            $jury_type = $jury->type;
            $jury_use = $jury->is_use;

            if ($jury_type == 'prive' && $jury_use != 0) {
                return redirect(route('form-authenticate'))->with('unsuccessJury', 'Desolé, vous ne pouvez plus accéder au vote.');
            }
            $jury_id = $jury->id;
            $jury_token = $jury->token;
            if ($jury_type == "prive") {
                if ($jury_token == "0") {
                    $token = $jury->createToken($juryCoupon)->plainTextToken;
                    $jury->token = $token;
                    $jury->is_use = 1;
                    $jury->save();
                }
            } else {
                if ($jury_token == "0") {
                    $token = $jury->createToken($juryCoupon)->plainTextToken;
                    $jury->token = $token;
                    $jury->is_use = $jury_use + 1;
                    $jury->save();
                } else {
                    $jury->is_use = $jury_use + 1;
                    $jury->save();
                }
            }

            $phase_id = Phase::where('slug', $phaseSlug)->first()->id;
            $phaseAndSpeaker = Phase::with('intervenants')->findOrFail($phase_id);
            $candidats = $phaseAndSpeaker->intervenants->pluck('id');
            $evenement = Evenement::findOrFail($phase->evenement_id);

            return redirect()->route('jury.success', [
                'phase_id' => $phase_id,
                'jury_id' => $jury_id,
                'candidats' => $candidats,
                'criteres' => $criteres,
                'nombreUser' => $jury->is_use,
                'evenement' => $evenement
            ])->withCookie(cookie('juryToken', $jury->token, 720));
        } else {
            return redirect(route('form-authenticate'))->with('unsuccessJury', 'Le coupon inséré est invalide.');
        }
    }

    public function results($phase_id)
    {
        $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
        $criterePhases = PhaseCritere::where('phase_id', $phase_id)->get();
        $numberCritere = $criterePhases->count();
        $ponderationTotale = 0;
        foreach ($criterePhases as $key => $criterePhase) {
            $critere = Critere::findOrFail($criterePhase->critere_id);
            $ponderationTotale += $critere->ponderation;
        }

        $juryPhase = JuryPhase::where('phase_id', $phase_id)->first();
        if ($juryPhase) {
            $ponderationJuryPublic = $juryPhase->ponderation_public;
            $ponderationJuryPrive = $juryPhase->ponderation_prive;
            $typeVote = $juryPhase->type;
        } else {
            $ponderationJuryPublic = 0;
            $ponderationJuryPrive = 0;
            $typeVote = 'prive et public';
        }

        $intervenants = [];
        $totalVoteByCandidat = 0;
        $totalVote = 0;
        $nombreMaxJury = 0;
        foreach ($intervenantPhases as $intervenantPhase) {
            $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
            $groupe = Groupe::find($intervenant->groupe_id);
            $intervenant->intervenantPhaseId = $intervenantPhase->id;

            $JuryByCandidat = Vote::where('intervenant_phase_id', $intervenantPhase->id)
                ->distinct('jury_phase_id')
                ->pluck('jury_phase_id');

            $votes = Vote::whereIn('jury_phase_id', $JuryByCandidat)
                ->where('intervenant_phase_id', $intervenantPhase->id)
                ->get();

            $jurys = Jury::whereIn('id', $JuryByCandidat)->get()->keyBy('id');

            foreach ($votes as $vote) {
                $jury = $jurys->get($vote->jury_phase_id);
                $vote->jury_type = $jury ? $jury->type : null;
            }

            $sommeByType = $votes->groupBy('jury_type')->map(function ($group) {
                return $group->sum('cote');
            });

            $moyenne = 0;
            foreach ($votes as $vote) {
                $moyenne += $vote->cote;
            }
            $numberVoteByInter = $votes->count();

            $totalVoteByCandidat = $moyenne;

            $nombreJuryIntervenant = $JuryByCandidat->count();
            if ($nombreJuryIntervenant > $nombreMaxJury) {
                $nombreMaxJury = $nombreJuryIntervenant;
            }

            if ($numberVoteByInter != 0) {
                $JuryByCandidat = $numberVoteByInter / $numberCritere;
            } else {
                $JuryByCandidat = 0;
            }
            $sommeByTypePrive = $sommeByType->get('prive', 0);
            $sommeByTypePublic = $sommeByType->get('public', 0);

            if ($typeVote == 'prive et public') {
                $sommeByTypePrive = round(($sommeByTypePrive) * ($ponderationJuryPrive / 100), 2);
                $sommeByTypePublic = round(($sommeByTypePublic) * ($ponderationJuryPublic / 100), 2);
                $cote = $sommeByTypePublic + $sommeByTypePrive;
                $totalVote += $cote;
            } else {
                $totalVote += $totalVoteByCandidat;
                $cote = $sommeByTypePublic + $sommeByTypePrive;
            }


            $intervenant->cote = $cote;
            $intervenant->nombreJury = $JuryByCandidat;
            $intervenant->votePublic = $sommeByTypePublic;
            $intervenant->votePrive = $sommeByTypePrive;

            $intervenants[] = $intervenant;
        }
        foreach ($intervenants as $intervenant) {
            if ($totalVote != 0) {
                $pourcentage = 0;
                if($intervenant->nombreJury){
                    $pourcentage = ($intervenant->cote * 100) / ($ponderationTotale * $intervenant->nombreJury);
                }
                $intervenant->pourcentage = round($pourcentage, 2);
                $intervenant->ponderation = ($ponderationTotale * $JuryByCandidat);
            } else {
                $intervenant->pourcentage = 0;
                $intervenant->ponderation = 0;
            }
        }


        usort($intervenants, function ($a, $b) {
            return $b->pourcentage - $a->pourcentage;
        });
        session(['breadPhase' => $phase_id]);
        $phase = Phase::findOrFail($phase_id);
        $evenement = Evenement::findOrFail($phase->evenement_id);
        //return response()->json($intervenants);
        return view('votes.showResultat', compact('intervenants', 'totalVote', 'ponderationJuryPublic', 'ponderationJuryPrive', 'typeVote', 'phase_id', 'evenement', 'phase'));
    }
}
