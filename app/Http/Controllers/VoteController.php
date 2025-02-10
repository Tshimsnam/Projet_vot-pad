<?php
namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Vote;
use App\Models\Phase;
use App\Models\Groupe;
use App\Models\Critere;
use App\Models\Reponse;
use App\Models\Evenement;
use App\Models\JuryPhase;
use App\Models\Intervenant;
use App\Models\PhaseCritere;
use Illuminate\Http\Request;
use App\Models\QuestionPhase;
use App\Models\IntervenantPhase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;

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
        $phaseAndSpeaker   = Phase::with('intervenants')->find($phase_id);
        $evenement         = Evenement::find($evenement_id);
        $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
        $intervenants      = [];
        $jury = Jury::find($jury_id);
        foreach ($intervenantPhases as $intervenantPhase) {
            $intervenant                     = Intervenant::find($intervenantPhase->intervenant_id);
            $groupe                          = Groupe::find($intervenant->groupe_id);
            $intervenant->intervenantPhaseId = $intervenantPhase->id;
            $intervenants[]                  = $intervenant;
        }

        usort($intervenants, function ($a, $b) {
            return strcmp($a->noms, $b->noms);
        });

        $votedCandidates = DB::table('votes')
            ->join('intervenant_phases', 'votes.intervenant_phase_id', '=', 'intervenant_phases.id')
            ->where('jury_phase_id', $jury_id)
            ->pluck('intervenant_phases.intervenant_id')
            ->toArray();


        return view('votes.show', compact('phaseAndSpeaker', 'phase_id', 'candidats', 'jury_id', 'criteres', 'intervenants', 'nombreUser', 'evenement', 'jury','votedCandidates'));
    }

    public function showIntervenant($slugPhase, $candidat_id, $jury_id, $nombreUser, $evenement)
    {
        $phase         = Phase::where('slug', $slugPhase)->first();
        $phase_id      = $phase->id;
        $phaseCriteres = PhaseCritere::where('phase_id', $phase_id)->get();
        $criteres      = [];
        foreach ($phaseCriteres as $phaseCritere) {
            $critere                 = Critere::find($phaseCritere->critere_id);
            $critere->criterePhaseId = $phaseCritere->id;
            $critere->echelle        = $phaseCritere->echelle;
            $critere->phase_id       = $phase_id;
            $criteres[]              = $critere;
        }
        usort($criteres, function ($a, $b) {
            return $a->id - $b->id;
        });
        $candidat  = Intervenant::findOrFail($candidat_id);
        $groupe    = Groupe::find($candidat->groupe_id);
        $jury      = Jury::findOrFail($jury_id);
        $juryToken = $jury->token;

        $evenement       = Evenement::where('id', $phase->evenement_id)->first();
        $phasePrecedente = Phase::where('evenement_id', $evenement->id)
            ->where('id', '<', $phase->id)
            ->orderBy('id', 'desc')
            ->first();

        $intervenant_resultat = [];

        if ($phasePrecedente) {
            $question                = QuestionPhase::where('phase_id', '=', $phasePrecedente->id)->get();
            $somme_ponderation_phase = $question->sum('ponderation');

            if ($somme_ponderation_phase > 0) {
                $intervenant = DB::table('intervenants')
                    ->join('intervenant_phases', "intervenant_phases.intervenant_id", "=", "intervenants.id")
                    ->select(
                        'intervenants.id as id',
                        'intervenants.email as email',
                        'intervenants.noms as noms',
                        'intervenants.genre as genre'
                    )
                    ->where("intervenant_phases.phase_id", "=", $phasePrecedente->id)
                    ->where('intervenants.id', '=', $candidat_id) // Filtrer uniquement pour ce candidat
                    ->first();

                if ($intervenant) {
                    $point_inter = Reponse::where('phase_id', '=', $phasePrecedente->id)
                        ->where('intervenant_id', '=', $candidat_id)
                        ->sum('cote');

                    $msg = Reponse::where('phase_id', '=', $phasePrecedente->id)
                        ->where('intervenant_id', '=', $candidat_id)
                        ->exists() ? 1 : null;

                    $pourcentage_interv = ($point_inter / $somme_ponderation_phase) * 100;
                    $pourcentage        = round($pourcentage_interv, 2);

                    $sexe = match (strtolower($intervenant->genre)) {
                        'm' => 'Masculine',
                        'f' => 'Féminine',
                        default => 'Non précisé',
                    };

                    $intervenant_resultat[] = [
                        'id'          => $intervenant->id,
                        'email'       => $intervenant->email,
                        'noms'        => $intervenant->noms,
                        'pourcentage' => $pourcentage,
                        'evaluee'     => $msg,
                        'genre'       => $sexe,
                    ];
                }
            }
        }
        $jury = Jury::find($jury_id);

        $votedCandidates = DB::table('votes')
            ->join('intervenant_phases', 'votes.intervenant_phase_id', '=', 'intervenant_phases.id')
            ->where('jury_phase_id', $jury_id)
            ->pluck('intervenant_phases.intervenant_id')
            ->toArray();

        return view("votes.showIntervenant", compact('criteres', 'phase_id', 'candidat_id', 'candidat', 'jury_id', 'juryToken', 'nombreUser', 'evenement', 'phase', 'intervenant_resultat', 'jury','votedCandidates'));
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

        if (! $request->has('coupon') && ! $request->hasCookie('juryToken')) {
            return redirect(route('form-authenticate'))->with('unsuccessJury', 'Veuillez vous authentifier.');
        }

        $request->validate([
            'coupon' => 'required|string',
        ]);

        $coupon = $request->coupon;

        if (Cache::has("used_coupon_{$coupon}")) {
            return redirect(route('form-authenticate'))->with('unsuccessJury', 'Ce coupon a déjà été utilisé.');
        }

        $jury   = Jury::where('coupon', $coupon)->first();

        if ($jury) {
            $juryCoupon = $jury->coupon;
            $phaseSlug  = substr($juryCoupon, 0, 3);
            $phase      = Phase::where('slug', $phaseSlug)->first();

            $statutPhase = $phase->statut;
            if ($statutPhase != "En cours") {
                return redirect(route('form-authenticate'))->with('unsuccessJury', 'Desolé, vous ne pouvez pas accéder au vote maintenant.');
            }

            $phase_id      = $phase->id;
            $criterePhases = PhaseCritere::where('phase_id', $phase_id)->get();
            $criteres      = $criterePhases->pluck('critere_id')->sort()->values();
            $jury_type     = $jury->type;
            $jury_use      = $jury->is_use;

            if ($jury_type == 'prive' && $jury_use != 0) {
                return redirect(route('form-authenticate'))->with('unsuccessJury', 'Desolé, vous ne pouvez plus accéder au vote.');
            }
            $jury_id    = $jury->id;
            $jury_token = $jury->token;
            if ($jury_type == "prive") {
                if ($jury_token == "0") {
                    $token        = $jury->createToken($juryCoupon)->plainTextToken;
                    $jury->token  = $token;
                    $jury->is_use = 1;
                    $jury->save();
                }
            } else {
                if ($jury_token == "0") {
                    $token        = $jury->createToken($juryCoupon)->plainTextToken;
                    $jury->token  = $token;
                    $jury->is_use = $jury_use + 1;
                    $jury->save();
                } else {
                    $jury->is_use = $jury_use + 1;
                    $jury->save();
                }
            }

            $phase_id        = Phase::where('slug', $phaseSlug)->first()->id;
            $phaseAndSpeaker = Phase::with('intervenants')->findOrFail($phase_id);
            $candidats       = $phaseAndSpeaker->intervenants->pluck('id');
            $evenement       = Evenement::findOrFail($phase->evenement_id);

            Cache::put("used_coupon_{$coupon}", true, 3600);

            return redirect()->route('jury.success', [
                'phase_id'   => $phase_id,
                'jury_id'    => $jury_id,
                'candidats'  => $candidats,
                'criteres'   => $criteres,
                'nombreUser' => $jury->is_use,
                'evenement'  => $evenement,
            ])->withCookie(cookie('juryToken', $jury->token, 720));
        } else {
            return redirect(route('form-authenticate'))->with('unsuccessJury', 'Le coupon inséré est invalide.');
        }
    }

    public function results($phase_id)
    {
        $user              = Auth::user();
        $phase             = Phase::find($phase_id);
        $evenement_user_id = Evenement::find($phase->evenement_id)->user_id;
        if ($user->role == 'super-momekano') {
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
            $criterePhases     = PhaseCritere::where('phase_id', $phase_id)->get();
        } else if ($user->id == $evenement_user_id) {
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->get();
            $criterePhases     = PhaseCritere::where('phase_id', $phase_id)->get();
        } else {
            return response()->json(['error' => 'Vous n\'avez pas les droits pour accéder à cette page'], 403);
        }

        $numberCritere     = $criterePhases->count();
        $ponderationTotale = 0;
        foreach ($criterePhases as $key => $criterePhase) {
            $critere = Critere::findOrFail($criterePhase->critere_id);
            $ponderationTotale += $critere->ponderation;
        }

        $juryPhase = JuryPhase::where('phase_id', $phase_id)->first();
        if ($juryPhase) {
            $ponderationJuryPublic = $juryPhase->ponderation_public;
            $ponderationJuryPrive  = $juryPhase->ponderation_prive;
            $typeVote              = $juryPhase->type;
        } else {
            $ponderationJuryPublic = 0;
            $ponderationJuryPrive  = 0;
            $typeVote              = 'prive et public';
        }

        $intervenants        = [];
        $totalVoteByCandidat = 0;
        $totalVote           = 0;
        $nombreMaxJury       = 0;
        foreach ($intervenantPhases as $intervenantPhase) {
            $intervenant                     = Intervenant::find($intervenantPhase->intervenant_id);
            $groupe                          = Groupe::find($intervenant->groupe_id);
            $intervenant->intervenantPhaseId = $intervenantPhase->id;

            $JuryByCandidat = Vote::where('intervenant_phase_id', $intervenantPhase->id)
                ->distinct('jury_phase_id')
                ->pluck('jury_phase_id');

            $votes = Vote::whereIn('jury_phase_id', $JuryByCandidat)
                ->where('intervenant_phase_id', $intervenantPhase->id)
                ->get();

            $jurys = Jury::whereIn('id', $JuryByCandidat)->get()->keyBy('id');

            foreach ($votes as $vote) {
                $jury            = $jurys->get($vote->jury_phase_id);
                $vote->jury_type = $jury ? $jury->type : null;
            }

            $sommeByType = $votes->groupBy('jury_type')->map(function ($group) {
                return $group->sum('cote');
            });

            $moyenne = 0;
            foreach ($votes as $vote) {
                $moyenne += $vote->cote;
            }

            $decisionOui = $votes->filter(function ($vote) {
                return $vote->decision === 'oui';
            })->count();
            $decisionOui = $decisionOui / $numberCritere;

            $decisionNon = $votes->filter(function ($vote) {
                return $vote->decision === 'non';
            })->count();
            $decisionNon = $decisionNon / $numberCritere;

            $decisionAttente = $votes->filter(function ($vote) {
                return $vote->decision === 'attente';
            })->count();
            $decisionAttente = $decisionAttente / $numberCritere;

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
            $sommeByTypePrive  = $sommeByType->get('prive', 0);
            $sommeByTypePublic = $sommeByType->get('public', 0);

            if ($typeVote == 'entretien' || $typeVote == 'Entretien') {
                $cote = $totalVoteByCandidat;
                $totalVote += $cote;
            } else if ($typeVote == 'prive et public') {
                $sommeByTypePrive  = round(($sommeByTypePrive) * ($ponderationJuryPrive / 100), 2);
                $sommeByTypePublic = round(($sommeByTypePublic) * ($ponderationJuryPublic / 100), 2);
                $cote              = $sommeByTypePublic + $sommeByTypePrive;
                $totalVote += $cote;
            } else {
                $totalVote += $totalVoteByCandidat;
                $cote = $sommeByTypePublic + $sommeByTypePrive;
            }

            $intervenant->cote       = $cote;
            $intervenant->nombreJury = $JuryByCandidat;
            $intervenant->votePublic = $sommeByTypePublic;
            $intervenant->votePrive  = $sommeByTypePrive;
            $intervenant->decisionOui = $decisionOui;
            $intervenant->decisionNon = $decisionNon;
            $intervenant->decisionAttente = $decisionAttente;
            $intervenant->phase_id = $phase_id;


            $intervenants[] = $intervenant;
        }

        foreach ($intervenants as $intervenant) {
            if ($totalVote != 0) {
                $pourcentage = 0;
                if ($intervenant->nombreJury) {
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
        $phase     = Phase::findOrFail($phase_id);
        $evenement = Evenement::findOrFail($phase->evenement_id);

        //return response()->json($intervenants);
        return view('votes.showResultat', compact('intervenants', 'totalVote', 'ponderationJuryPublic', 'ponderationJuryPrive', 'typeVote', 'phase_id', 'evenement', 'phase'));
    }


    public function getVotes($intervenant_id, $phase_id)
    {

        $intervenant = DB::table('intervenants')
            ->where('id', $intervenant_id)
            ->select('noms') // Assure-toi que la colonne correspond au nom de l'intervenant
            ->first();

        // requettes
        $juriesByCandidatWithCotes = DB::table('juries')
            ->join('jury_phases', 'juries.id', '=', 'jury_phases.jury_id')
            ->join('votes', 'jury_phases.id', '=', 'votes.jury_phase_id')
            ->join('phase_criteres', function ($join) {
                $join->on('jury_phases.phase_id', '=', 'phase_criteres.phase_id')
                     ->on('votes.phase_critere_id', '=', 'phase_criteres.critere_id');
            })
            ->join('criteres', 'phase_criteres.critere_id', '=', 'criteres.id')
            ->where('jury_phases.phase_id', $phase_id)
            ->where('votes.intervenant_phase_id', $intervenant_id)
            ->select('juries.noms as jury_name', 'criteres.libelle as critere_name', 'votes.cote')
            ->get();

        //tableau associatif
        $juryCotes = [];
        foreach ($juriesByCandidatWithCotes as $vote) {
            if (!isset($juryCotes[$vote->jury_name])) {
                $juryCotes[$vote->jury_name] = [];
            }

            $juryCotes[$vote->jury_name][] = [
                'critere' => $vote->critere_name,
                'cote'    => $vote->cote
            ];
        }

        // Retourner les données en JSON
        return response()->json([
            'intervenant_id' => $intervenant_id,
            'intervenant_nom' => $intervenant ? $intervenant->noms : 'Inconnu',
            'phase_id' => $phase_id,
            'juryCotes' => $juryCotes
        ]);
    }

}
