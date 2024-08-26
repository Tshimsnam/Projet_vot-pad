<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Vote;
use App\Models\Phase;
use App\Models\Groupe;
use App\Models\Critere;
use App\Models\Question;
use App\Models\Assertion;
use App\Models\Evenement;
use App\Models\JuryPhase;
use App\Models\Intervenant;
use App\Models\PhaseCritere;
use Illuminate\Http\Request;
use App\Models\QuestionPhase;
use App\Models\IntervenantPhase;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use App\Models\Reponse;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PhaseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phase = Phase::latest()->get();
        return view("phases.index", compact("phase"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($evenements)
    {
        $evenement = Evenement::find($evenements);
        return view("phases.create", compact('evenement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhaseRequest $request)
    {
        $request->validated([
            'nom' => 'require [ max:50 | min:3',
            'description' => 'require'
        ]);
        $evenement_id = $request->evenement_id;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 3;
        $slug = null;

        do {
            $slug = '';
            for ($i = 0; $i < $codeLength; $i++) {
                $position = mt_rand(0, $charactersNumber - 1);
                $slug .= $characters[$position];
            }
        } while (Phase::where('slug', $slug)->exists());

        $phase = Phase::create(
            [
                'nom' => $request->nom,
                'description' => $request->description,
                'statut' => 'en attente',
                'slug' => $slug,
                'type' => $request->type,
                'duree' => $request->duree,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'evenement_id' => $evenement_id
            ]

        );

        $autoCreate = 0;
        $evenement = Evenement::findOrFail($evenement_id);
        $evenement->auto_create = $autoCreate;
        $evenement->save();
        return redirect()->route('evenements.show', $evenement_id)->with('success', 'Enregistrement reussi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Phase $phase, $evenements)
    {
        $evenement = Evenement::find($evenements);
        $phaseShow = $phase;
        $question = Question::latest()->get();
        return view('phases.show', compact('phaseShow', 'question', 'evenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phase $phase, Evenement $evenements)
    {
        $phaseEdit = $phase;
        $evenement = Evenement::find($phase->evenement_id);
        return view('phases.edit', compact('phaseEdit', 'evenement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhaseRequest $request, Phase $phase)
    {
        $phase->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'duree' => $request->duree
        ]);

        return redirect(route('phase.show', $phase->id))->with('success', 'phase modifiée avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phase $phase)
    {
        $evenement = Evenement::find($phase->evenement_id);
        $evenement_id = $evenement->id;
        $phase->delete();
        $phases = $evenement->phases;
        return redirect()->route('evenements.show', $evenement_id)->with('success', 'Phase supprimée avec succes');
    }

    public function active()
    {
        $phase = Phase::latest()->where("statut", "active")->get();
        return view("phases.index", compact("phase"));
    }
    public function encours()
    {
        $phase = Phase::latest()->where("statut", "encours")->get();
        return view("phases.index", compact("phase"));
    }
    public function desactive()
    {
        $phase = Phase::latest()->where("statut", "desactive")->get();
        return view("phases.index", compact("phase"));
    }
    public function enAttente()
    {
        $phase = Phase::latest()->where("statut", "en attente")->get();
        return view("phases.index", compact("phase"));
    }
    public function pause()
    {
        $phase = Phase::latest()->where("statut", "pause")->get();
        return view("phases.index", compact("phase"));
    }
    public function terminer()
    {
        $phase = Phase::latest()->where("statut", "terminer")->get();
        return view("phases.index", compact("phase"));
    }

    public function evenementPhase(Request $request, $id)
    {
        $phaseShow1 = Phase::latest()->where('id', $id)->get();
        foreach ($phaseShow1 as $key => $value) {
            $evenement = $value->evenement_id;
            $phase_type = $value->type;
            $phase_id = $value->id;
            $status_phase = $value->statut;
            $passNumber = $value->passation_nombre;
        }

        $phaseShow = DB::table('evenements')
            ->join('phases', "evenements.id", "=", "phases.evenement_id")
            ->select(
                'evenements.id as id_event',
                'evenements.nom as nom_event',
                'evenements.type as type_envent',
                'status as stat_event',
                'phases.id as id',
                'phases.nom as nom_phase',
                'phases.description as decrip_phase',
                'phases.statut as stat_phase',
                'phases.date_debut as debut_phase',
                'phases.date_fin as fin_phase',
                'phases.type as type_phase'
            )
            ->where("evenements.id", "=", (isset($evenement)) ? $evenement : null)
            ->where("phases.id", "=", $id)
            ->get();

        $question = Question::latest()->get();

        $questionPhase0 = QuestionPhase::orderBy('id')->where("phase_id", $id)->get();
        $questionPhasePagnation = QuestionPhase::orderBy('id')->where("phase_id", $id)->paginate(10);
        // dd($questionPhase0[0]->question->question);

        $tabAssertion = array();
        $questionPhase = array();
        foreach ($questionPhase0 as $key => $valeur) {
            $question_id = $valeur->id;
            $assertion = Assertion::where('question_id', $question_id)->count(); //nombre assertion liées
            $tabAssertion['assertNombre'] = $assertion;
            $tabAssertion['question'] = $valeur->question->question;
            $tabAssertion['ponderation'] = $valeur->ponderation;
            array_push($questionPhase, $tabAssertion);
        }
        $questionAssert = $questionPhase;


        if ($phase_type === 'Vote' || $phase_type === 'vote') {
            // module phase vote

            //recuperer les intervenats liés à une phase
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->latest()->paginate(10);
            $intervenants = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenants[] = $intervenant;
            }

            //recuperer les criteres liés à une phase
            $phases = $phaseShow;
            $phaseCriteres = PhaseCritere::where('phase_id', $phase_id)->latest()->paginate(10);
            $criteres = [];
            foreach ($phaseCriteres as $phaseCritere) {
                $critere = Critere::find($phaseCritere->critere_id);
                $critere->criterePhaseId = $phaseCritere->id;
                $criteres[] = $critere;
            }

            //rerecuperer les jurys liés à une phase
            $juryPhases = JuryPhase::where('phase_id', $phase_id)->latest()->paginate(10);

            if ($juryPhases->count() > 0) {
                $ponderation_public = $juryPhases->first()->ponderation_public;
                $ponderation_prive = $juryPhases->first()->ponderation_prive;
                $type_vote = $juryPhases->first()->type;
            } else {
                $ponderation_public = null;
                $ponderation_prive = null;
                $type_vote = null;
            }

            $jurys = [];
            foreach ($juryPhases as $juryPhase) {
                if (is_string($juryPhase->jury_id) && json_decode($juryPhase->jury_id, true) !== null) {
                    $juryIds = json_decode($juryPhase->jury_id, true);
                } else {
                    $juryIds = $juryPhase->jury_id;
                }

                if (is_array($juryIds)) {
                    $updatedJuryIds = [];
                    foreach ($juryIds as $juryId) {
                        $jury = Jury::find($juryId);
                        if ($jury) {
                            if ($jury->type == 'prive') {
                                $jury->ponderation = $juryPhase->ponderation_prive;
                            } else {
                                $jury->ponderation = $juryPhase->ponderation_public;
                            }
                            $coupon = $jury->coupon;
                            $qrCode = QrCode::size(650)->generate($coupon);
                            $jury->qr_code = $qrCode;
                            $updatedJuryIds[] = $juryId;
                            $jurys[] = $jury;
                        }
                    }
                    $juryPhase->jury_id = json_encode($updatedJuryIds);
                    $juryPhase->save();
                } else {
                    $jury = Jury::find($juryIds);
                    if ($jury) {
                        if ($jury->type == 'prive') {
                            $jury->ponderation = $juryPhase->ponderation_prive;
                        } else {
                            $jury->ponderation = $juryPhase->ponderation_public;
                        }
                        $coupon = $jury->coupon;
                        $qrCode = QrCode::size(600)->generate($coupon);
                        $jury->qr_code = $qrCode;
                        $jurys[] = $jury;
                    }
                }
            }
            usort($jurys, function ($a, $b) {
                if ($a->type == $b->type) {
                    return 0;
                }
                return $a->type == 'prive' ? -1 : 1;
            });
            usort($intervenants, function ($a, $b) {
                return strcmp($a->noms, $b->noms);
            });
            return view('criteres.index', compact('criteres', 'phaseCriteres', 'phases', 'phase_id', 'intervenants', 'intervenantPhases', 'jurys', 'juryPhases', 'ponderation_public', 'ponderation_prive', 'type_vote', 'status_phase', 'passNumber'));
        } else {
            // module phase evaluation
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->latest()->paginate(10);
            $intervenants = [];
            $intervenantsMails = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                if ($intervenant) {
                    $intervenant->intervenantPhaseId = $intervenantPhase->id;
                    $intervenant->coupon = $intervenantPhase->coupon;
                    $intervenant->mail_send = $intervenantPhase->mail_send;
                    if ($intervenantPhase->token == 0) {
                        $intervenant->is_use = 0;
                    } else {
                        $intervenant->is_use = 1;
                    }
                    $intervenants[] = $intervenant;
                }
            }
            usort($intervenants, function ($a, $b) {
                return strcmp($a->noms, $b->noms);
            });

            foreach ($intervenants as $intervenant) {
                $intervenantPhaseMail = IntervenantPhase::where('phase_id', $phase_id)->where('intervenant_id', $intervenant->id)->first();
                if ($intervenantPhaseMail->token == 0) {
                    $intervenantsMails[] = $intervenant;
                }
            }

            return view('phases.show', compact('phaseShow', 'phase_id', 'question', 'questionPhasePagnation', 'questionAssert', 'intervenants', 'intervenantPhases', 'intervenantsMails'));
        }
    }
    public function phaseQuestionDetail(Request $request, $id)
    {
        $phaseShow = Phase::select("id")->latest()->where('id', $id)->first();

        $questionPhasePagnation = QuestionPhase::orderBy('id')->where("phase_id", $phaseShow->id)->paginate(25);
        // dd($questionPhasePagnation);
        return view('phases.question_phase', compact('questionPhasePagnation'));
    }

    //changer le status de la phase	

    public function changeStatus($phaseId, $status)
    {
        $phase = Phase::find($phaseId);
        $phase->statut = $status;
        $phase->update();

        $evenementId = $phase->evenement_id;
        $evenement = Evenement::find($evenementId);

        if ($status == 'En cours' || $status == 'en cours') {
            $evenement->status = $status;
            $evenement->update();
        } else if ($status == 'Cloturer' || $status == 'cloturer') {

            $phaseStart = Phase::findOrFail($phaseId);
            $evenementId = $phaseStart->evenement_id;
            $passNumber = $phaseStart->passation_nombre;

            $allPhaseEvent = Phase::where('evenement_id', $evenementId)->orderBy('id')->get();

            $nextPhase = null;
            foreach ($allPhaseEvent as $phase) {
                if ($phase->id > $phaseStart->id) {
                    $nextPhase = $phase;
                    break;
                }
            }

            $intervenantPhases = IntervenantPhase::where('phase_id', $phaseId)->latest()->get();
            $intervenants = [];
            $voteByCandidat = [];
            $coteMoyenne = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                $groupe = Groupe::find($intervenant->groupe_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenant->nom_groupe = $groupe->nom;
                $intervenant->image = $groupe->image;

                $voteByCandidat[$intervenantPhase->id] = Vote::where('intervenant_phase_id', $intervenantPhase->id)->get();
                $coteMoyenne = [];
                foreach ($voteByCandidat as $intervenantPhaseId => $votes) {
                    $totalCote = 0;
                    foreach ($votes as $vote) {
                        $totalCote += $vote->cote;
                    }
                    $coteMoyenne[$intervenantPhaseId] = $totalCote;
                }

                $intervenant->cote = $coteMoyenne[$intervenantPhase->id];
                $intervenants[] = $intervenant;
            }
            usort($intervenants, function ($a, $b) {
                return $b->cote - $a->cote;
            });

            $topIntervenants = array_slice($intervenants, 0, $passNumber);

            // insertion des intervnants qualifiés
            if ($nextPhase) {
                foreach ($topIntervenants as $intervenant) {
                    $slug = $nextPhase->slug;
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersNumber = strlen($characters);
                    $codeLength = 3;
                    $coupon = null;
                    $isVote = $nextPhase->type;
                    $data = [];
                    $now = date('Y-m-d H:i:s');
                    if ($isVote == 'Vote' || $isVote == 'vote') {

                        $getIntervenant = Intervenant::where('email', $intervenant->email)->first();
                        if ($getIntervenant) {
                            $intervenantId = $getIntervenant->id;
                        } else {
                            $groupe = new Groupe();
                            if ($intervenant->image === null) {
                                $groupe->nom = $intervenant->nom_groupe;
                            } else {
                                $groupe->nom = $intervenant->nom_groupe;
                                $groupe->image = $intervenant->image;
                            }
                            $groupe->save();
                            $groupeId = $groupe->id;

                            $intervenant = Intervenant::create([
                                'email' => $intervenant->email,
                                'groupe_id' => $groupeId,
                            ]);
                            $intervenantId = $intervenant->id;
                        }
                        do {
                            $coupon = '';
                            for ($i = 0; $i < $codeLength; $i++) {
                                $position = mt_rand(0, $charactersNumber - 1);
                                $coupon .= $characters[$position];
                            }
                        } while (IntervenantPhase::where('coupon', $coupon)->exists());

                        $couponPhase = $slug . $coupon;

                        $data[] = [
                            'intervenant_id' => $intervenantId,
                            'phase_id' => $nextPhase->id,
                            'coupon' => $couponPhase,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    } else {
                        $getIntervenant = Intervenant::where('email', $intervenant->email)->first();
                        if ($getIntervenant) {
                            $intervenantId = $getIntervenant->id;
                        } else {
                            $intervenant = Intervenant::create([
                                'email' => $intervenant->email,
                                'created_at' => $now,
                                'updated_at' => $now,
                            ]);
                            $intervenantId = $intervenant->id;
                        }

                        do {
                            $coupon = '';
                            for ($i = 0; $i < $codeLength; $i++) {
                                $position = mt_rand(0, $charactersNumber - 1);
                                $coupon .= $characters[$position];
                            }
                        } while (IntervenantPhase::where('coupon', $coupon)->exists());

                        $couponPhase = $slug . $coupon;

                        $data[] = [
                            'intervenant_id' => $intervenantId,
                            'phase_id' => $nextPhase->id,
                            'coupon' => $couponPhase,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    IntervenantPhase::insert($data);
                }
            }
        }

        if ($status == 'Cloturer' || $status == 'cloturer') {
            return redirect(route('phase.show', $phaseId))->with('successStatus', 'Phase cloturée avec succès');
        } else if ($status == 'En cours' || $status == 'en cours') {
            return redirect(route('phase.show', $phaseId))->with('successStatus', 'Phase lancée avec succès');
        } else {
            return redirect(route('phase.show', $phaseId))->with('successStatus', 'Phase fermée avec succès');
        }
    }

    public function closePhase(Request $request)
    {
        // dd($request->all());
        //    "nbr_retenu" => "5"
        //   "phase_id" => "1"
        $phase = Phase::where('id', '=', $request->phase_id)->where('type', '=', 'evaluation')->get(); //recuper phase du type evaluation
        if ($phase) {
            $question = QuestionPhase::where('phase_id', '=', $phase[0]->id)->get();
            $somme_ponderation_phase = 0;
            foreach ($question as $cle => $valeur) {
                $ponde = $valeur->ponderation;
                $somme_ponderation_phase += $ponde;
            }
            $somme_ponderation_phase;

            $intervenant_resultat = array();
            $tableau = array();
            $intervants = DB::table('intervenants')
                ->join('intervenant_phases', "intervenant_phases.intervenant_id", "=", "intervenants.id")
                ->select(
                    'intervenants.id as id',
                    'intervenants.email as email',
                )
                ->where("intervenant_phases.phase_id", "=", $phase[0]->id)
                ->get();

            foreach ($intervants as $key => $value) {
                $point_inter = 0;
                $cote = Reponse::where('phase_id', '=', $phase[0]->id)->where('intervenant_id', '=', $value->id)->get();
                foreach ($cote as $k => $v) {
                    $point_inter += $v->cote;
                }

                $pourcentage_interv = ($point_inter / $somme_ponderation_phase) * 100;

                $pourcentage = round($pourcentage_interv, 2);

                $tableau['id'] = $value->id;
                $tableau['email'] = $value->email;
                $tableau['pourcentage'] = $pourcentage;
                array_push($intervenant_resultat, $tableau);
            }
            // dd($intervenant_resultat);
            usort($intervenant_resultat, function ($a, $b) {
                return $b['pourcentage'] - $a['pourcentage'];
            });

            $event = Phase::where('evenement_id', $phase[0]->evenement->id)->get();
            $total_intervenant = count($intervenant_resultat);
            $interv_retenu_passage = [];
            $tous = "";
            if ($total_intervenant >= $request->nbr_retenu) {
                for ($i = 0; $i < $request->nbr_retenu; $i++) {
                    $intervenant_resultat[$i];
                    array_push($interv_retenu_passage, $intervenant_resultat[$i]);
                }
                $tous = "non";
            } else {
                $tous = 'oui';
                for ($i = 0; $i < $total_intervenant; $i++) {
                    $intervenant_resultat[$i];
                    array_push($interv_retenu_passage, $intervenant_resultat[$i]);
                }
            }
            $next_phase = "c'est la derniere phase enregistree pour cette phase";
            $next_phase_cle = "";
            foreach ($event as $key => $val) {
                if ($val->id == $phase[0]->id) {
                    if ($key + 1 < count($event)) {
                        $next_phase_cle = $key + 1;
                        $next_phase = $event[$next_phase_cle];

                        foreach ($interv_retenu_passage as $intervenant) {
                            $slug = $next_phase->slug;
                            // dd($slug);
                            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersNumber = strlen($characters);
                            $codeLength = 3;
                            $coupon = null;

                            $getIntervenant = Intervenant::where('email', $intervenant['email'])->first();
                            // dd($getIntervenant);
                            if ($getIntervenant) {
                                $intervenantId = $getIntervenant->id;
                                do {
                                    $coupon = '';
                                    for ($i = 0; $i < $codeLength; $i++) {
                                        $position = mt_rand(0, $charactersNumber - 1);
                                        $coupon .= $characters[$position];
                                    }
                                } while (IntervenantPhase::where('coupon', $coupon)->exists());
                                // dd($coupon);
                                $couponPhase = $slug . $coupon;
                                // dd($couponPhase);
                                $passage_success = IntervenantPhase::create([
                                    'intervenant_id' => $intervenantId,
                                    'phase_id' => $next_phase->id,
                                    'coupon' => $couponPhase
                                ]);
                            }
                        }
                    }
                    break;
                }
            }
            $phaseintervenant_update = DB::table('phases')
                ->where('id', $phase[0]->id)
                ->update(['statut' => 'cloturer']);

            // dd($intervenant_resultat, $request->nbr_retenu,$interv_retenu_passage,$tous,$total_intervenant,$next_phase);

            return back()->with("success", "Phase clorée avec succes");
        } else {
            return Redirect::back();
        }
    }
    public function editPhase($id)
    {
        $phaseShow1 = Phase::latest()->where('id', $id)->get();
        foreach ($phaseShow1 as $key => $value) {
            $evenement = $value->evenement_id;
        } //recuperation de l' id de l'evenement

        $phaseEdit = DB::table('evenements')
            ->join('phases', "evenements.id", "=", "phases.evenement_id")
            // ->select('evenements.*', 'phases.*') //on recupere tout mais avec conflit de champs identitiques
            ->select(
                'evenements.id as id_event',
                'evenements.nom as nom_event',
                'type as type_envent',
                'status as stat_event',
                'phases.id as id',
                'phases.nom as nom_phase',
                'phases.description as decrip_phase',
                'phases.statut as stat_phase',
                'phases.date_debut as debut_phase',
                'phases.date_fin as fin_phase'
            )
            ->where("evenements.id", "=", (isset($evenement)) ? $evenement : null)
            ->where("phases.id", "=", $id)
            ->get();

        return view('phases.edit', compact('phaseEdit'));
    }

    public function passation(Request $request)
    {
        $phaseId = $request->phase;
        $passNumber = $request->nombre_candidat;
        $passPourcent = $request->pourcent_candidat;

        $phaseStart = Phase::findOrFail($phaseId);

        $phaseStart->passation_nombre = $passNumber;
        $phaseStart->update();

        return redirect(route('phase.show', $phaseId))->with('successCand', 'La passation à la phase suivante enregistrée avec succès');
    }
}
