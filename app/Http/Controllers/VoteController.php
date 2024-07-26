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

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($event)
    {
        $phases = null;
        $eventId = $event;
        $event = Evenement::where('id', $eventId)->first();
        if ($event) {
            $phases = $event->phases;
        }
        return view("votes.index", compact('phases'));
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
    public function show()
    {
        //
    }

    public function showIntervenant($slugPhase, $candidat_id, $jury_id)
    {
        $phase = Phase::where('slug', $slugPhase)->first();
        $phase_id = $phase->id;
        $phaseCriteres = PhaseCritere::where('phase_id', $phase_id)->latest()->paginate(10);
        $criteres = [];
        foreach ($phaseCriteres as $phaseCritere) {
            $critere = Critere::find($phaseCritere->critere_id);
            $critere->criterePhaseId = $phaseCritere->id;
            $critere->echelle = $phaseCritere->echelle;
            $critere->phase_id = $phase_id;
            $criteres[] = $critere;
        }
        $candidat = Intervenant::findOrFail($candidat_id);
        return view("votes.showIntervenant", compact('criteres', 'phase_id', 'candidat_id', 'candidat', 'jury_id'));
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
        $coupon = $request->coupon;
        $jury = Jury::where('coupon', $coupon)->first();

        if ($jury) {
            $juryCoupon = $jury->coupon;
            $phaseSlug = substr($juryCoupon, 0, 3);
            $phase = Phase::where('slug', $phaseSlug)->first();

            $jury_id = $jury->id;
            $jury_type = $jury->type;
            $jury_use = $jury->is_use;
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
            return view("votes.show", compact('phaseAndSpeaker', 'phase_id', 'candidats', 'jury_id'));
        } else {
            return redirect(route('jury-form'))->with('unsuccess', 'Le coupon inséré est invalide.');
        }
    }
}
