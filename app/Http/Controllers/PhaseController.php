<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use App\Models\Assertion;
use App\Models\Critere;
use App\Models\Evenement;
use App\Models\Groupe;
use App\Models\Intervenant;
use App\Models\IntervenantPhase;
use App\Models\Jury;
use App\Models\JuryPhase;
use App\Models\Phase;
use App\Models\PhaseCritere;
use App\Models\Question;
use App\Models\QuestionPhase;
use App\Models\Reponse;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        session(['breadEvenement' => $evenement->id]);
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
        $evenement = Evenement::find($phase->evenement_id);
        session(['breadEvenement' => $evenement->id]);

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
        $user = Auth::user();
        $phase = Phase::find($id);
        $evenement = Evenement::find($phase->evenement_id);

        if ($user->role == 'super-momekano') {
            $phaseShow1 = Phase::latest()->where('id', $id)->get();
        } else if ($user->id == $evenement->user_id) {
            $phaseShow1 = Phase::latest()->where('id', $id)->get();
        } else {
            return response()->json(['error' => 'Vous n\'avez pas les droits pour accéder à cette page'], 403);
        }
        
        foreach ($phaseShow1 as $key => $value) {
            $evenement = $value->evenement_id;
            $phase_type = $value->type;
            $phase_id = $value->id;
            $status_phase = $value->statut;
            $passNumber = $value->passation_nombre;
            $passPourcent = $value->passation_pourcent;
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
                'phases.type as type_phase',
                'phases.duree as duree'
            )
            ->where("evenements.id", "=", (isset($evenement)) ? $evenement : null)
            ->where("phases.id", "=", $id)
            ->get();

        $question = Question::latest()->get();

        $questionPhase0 = QuestionPhase::orderBy('id')->where("phase_id", $id)->get();
        $questionPhasePagnation = QuestionPhase::orderBy('id')->where("phase_id", $id)->paginate(5, ['*'], 'question_page');
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

        session(['breadEvenement' => $evenement]);

        if ($phase_type === 'Vote' || $phase_type === 'vote') {
            // module phase vote

            //recuperer les intervenats liés à une phase
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->paginate(10, ['*'], 'intervenant_page');
            $page = $intervenantPhases->currentPage();
            $intervenantPhasesAll = IntervenantPhase::where('phase_id', $phase_id)->latest()->get();
            $intervenantAll = [];
            $intervenants = [];
            $intervenantsMails = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenant->mail_send = $intervenantPhase->mail_send;
                $intervenants[] = $intervenant;
            }
            $totalIntervenants = $intervenantPhases->total();

            foreach ($intervenantPhasesAll as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                if ($intervenant) {
                    $intervenant->intervenantPhaseId = $intervenantPhase->id;
                    $intervenant->coupon = $intervenantPhase->coupon;
                    $intervenant->mail_send = $intervenantPhase->mail_send;
                    $intervenant->is_use = $intervenantPhase->token == 0 ? 0 : 1;
                    $intervenantAll[] = $intervenant;
                }
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
                return strtolower($a->noms) <=> strtolower($b->noms);
            });

            $intervenantsFeminin = array_filter($intervenantAll, function ($intervenant) {
                return strtolower($intervenant->genre) === 'f';
            });

            foreach ($intervenantAll as $intervenant) {
                $intervenantPhaseMail = IntervenantPhase::where('phase_id', $phase_id)->where('intervenant_id', $intervenant->id)->first();
                if ($intervenantPhaseMail->token == 0 && $intervenantPhaseMail->mail_send == 0) {
                    $intervenantsMails[] = $intervenant;
                }
            }
            usort($intervenantsMails, function ($a, $b) {
                return strtolower($a->noms) <=> strtolower($b->noms);
            });
            $phaseExist = Phase::findOrFail($phase_id);
            return view('criteres.index', compact('criteres', 'phaseCriteres', 'phases', 'phase_id', 'intervenants', 'intervenantPhases', 'jurys', 'juryPhases', 'ponderation_public', 'ponderation_prive', 'type_vote', 'status_phase', 'passNumber', 'intervenantsMails', 'intervenantsFeminin', 'phaseExist', 'totalIntervenants', 'intervenantAll', 'page'));
        } else if ($phase_type === 'Entretien' || $phase_type === 'entretien') {

            // module phase entretien

            //recuperer les intervenats liés à une phase
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->paginate(10, ['*'], 'intervenant_page');
            $page = $intervenantPhases->currentPage();
            $intervenantPhasesAll = IntervenantPhase::where('phase_id', $phase_id)->latest()->get();
            $intervenantAll = [];
            $intervenants = [];
            $intervenantsMails = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenant->mail_send = $intervenantPhase->mail_send;
                $intervenants[] = $intervenant;
            }
            $totalIntervenants = $intervenantPhases->total();

            foreach ($intervenantPhasesAll as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                if ($intervenant) {
                    $intervenant->intervenantPhaseId = $intervenantPhase->id;
                    $intervenant->coupon = $intervenantPhase->coupon;
                    $intervenant->mail_send = $intervenantPhase->mail_send;
                    $intervenant->is_use = $intervenantPhase->token == 0 ? 0 : 1;
                    $intervenantAll[] = $intervenant;
                }
            }
            //recuperer les criteres liés à une phase
            $phases = $phaseShow;
            $phaseCriteres = PhaseCritere::where('phase_id', $phase_id)->latest()->paginate(10);
            $criteres = [];
            $sommePonderation = 0;
            foreach ($phaseCriteres as $phaseCritere) {
                $critere = Critere::find($phaseCritere->critere_id);
                $critere->criterePhaseId = $phaseCritere->id;
                $sommePonderation += $critere->ponderation;
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
                return strtolower($a->noms) <=> strtolower($b->noms);
            });

            $intervenantsFeminin = array_filter($intervenantAll, function ($intervenant) {
                return strtolower($intervenant->genre) === 'f';
            });

            foreach ($intervenantAll as $intervenant) {
                $intervenantPhaseMail = IntervenantPhase::where('phase_id', $phase_id)->where('intervenant_id', $intervenant->id)->first();
                if ($intervenantPhaseMail->token == 0 && $intervenantPhaseMail->mail_send == 0) {
                    $intervenantsMails[] = $intervenant;
                }
            }
            usort($intervenantsMails, function ($a, $b) {
                return strtolower($a->noms) <=> strtolower($b->noms);
            });
            $phaseExist = Phase::findOrFail($phase_id);
            return view('entretiens.index', compact('criteres', 'phaseCriteres', 'phases', 'phase_id', 'intervenants', 'intervenantPhases', 'jurys', 'juryPhases', 'ponderation_public', 'ponderation_prive', 'type_vote', 'status_phase', 'passNumber', 'intervenantsMails', 'intervenantsFeminin', 'phaseExist', 'totalIntervenants', 'intervenantAll', 'page', 'sommePonderation'));

            //fin entretien
        } else {
            // module phase evaluation
            $phases = $phaseShow;
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->latest()->paginate(10, ['*'], 'intervenant_page');
            $intervenantPhasesAll = IntervenantPhase::where('phase_id', $phase_id)->latest()->get();
            $intervenantAll = [];

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

            foreach ($intervenantPhasesAll as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                if ($intervenant) {
                    $intervenant->intervenantPhaseId = $intervenantPhase->id;
                    $intervenant->coupon = $intervenantPhase->coupon;
                    $intervenant->mail_send = $intervenantPhase->mail_send;
                    $intervenant->is_use = $intervenantPhase->token == 0 ? 0 : 1;
                    $intervenantAll[] = $intervenant;
                }
            }
            usort($intervenants, function ($a, $b) {
                return strcmp($a->noms, $b->noms);
            });

            //return response()->json($intervenants);

            $intervenantsFeminin = array_filter($intervenantAll, function ($intervenant) {
                return strtolower($intervenant->genre) === 'f';
            });
            $totalQuestions = $questionPhasePagnation->total();
            $intervenantStart = [];
            foreach ($intervenantAll as $intervenant) {
                $intervenantPhaseMail = IntervenantPhase::where('phase_id', $phase_id)->where('intervenant_id', $intervenant->id)->first();
                $intervenantPhaseStart = IntervenantPhase::where('phase_id', $phase_id)->where('intervenant_id', $intervenant->id)->first();
                if ($intervenantPhaseMail->token != 0) {
                    $intervenantStart[] = $intervenant;
                }
                if ($intervenantPhaseMail->mail_send == 0 && $intervenantPhaseMail->token == 0) {
                    $intervenantsMails[] = $intervenant;
                }
            }
            $phaseExist = Phase::findOrFail($phase_id);
            return view('phases.show', compact('phaseShow', 'phase_id', 'question', 'questionPhasePagnation', 'questionAssert', 'intervenants', 'intervenantPhases', 'intervenantsMails', 'phases', 'status_phase', 'intervenantsFeminin', 'intervenantStart', 'passPourcent', 'phaseExist', 'intervenantAll'));
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
        //dd($phase->type);
        $phase->statut = $status;
        $phase->update();
        $evenementId = $phase->evenement_id;
        $evenement = Evenement::find($evenementId);

        $phaseStart = Phase::findOrFail($phaseId);

        if ($status == 'En cours' || $status == 'en cours') {
            $evenement->status = $status;
            $evenement->update();
        } else if ($status == 'Cloturer' || $status == 'cloturer') {

            if ($phase->type == 'Vote' || $phase->type == 'vote') {


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
                if ($nextPhase && $phaseStart->passation_nombre != null) {
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
            } else {
                $phase = Phase::where('id', '=', $phaseId)->where('type', '=', 'evaluation')->get(); //recuper phase du type evaluation
                if ($phase && $phaseStart->passation_pourcent != null) {
                    $passPourcent = $phaseStart->passation_pourcent;
                    //dd($passPourcent);
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

                    usort($intervenant_resultat, function ($a, $b) {
                        return $b['pourcentage'] - $a['pourcentage'];
                    });

                    $event = Phase::where('evenement_id', $phase[0]->evenement->id)->get();
                    $interv_retenu_passage = [];
                    foreach ($intervenant_resultat as $k => $v) {
                        if ($v["pourcentage"] >= $passPourcent) {
                            array_push($interv_retenu_passage, $intervenant_resultat[$k]);
                        }
                    }
                    $next_phase = "c'est la derniere phase enregistree pour cet evenement";
                    $next_phase_cle = "";
                    foreach ($event as $key => $val) {
                        if ($val->id == $phase[0]->id) {
                            if ($key + 1 < count($event)) {
                                $next_phase_cle = $key + 1;
                                $next_phase = $event[$next_phase_cle];

                                foreach ($interv_retenu_passage as $intervenant) {
                                    $slug = $next_phase->slug;

                                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                    $charactersNumber = strlen($characters);
                                    $codeLength = 3;
                                    $coupon = null;

                                    $getIntervenant = Intervenant::where('email', $intervenant['email'])->first();

                                    if ($getIntervenant) {
                                        $intervenantId = $getIntervenant->id;
                                        do {
                                            $coupon = '';
                                            for ($i = 0; $i < $codeLength; $i++) {
                                                $position = mt_rand(0, $charactersNumber - 1);
                                                $coupon .= $characters[$position];
                                            }
                                        } while (IntervenantPhase::where('coupon', $coupon)->exists());

                                        $couponPhase = $slug . $coupon;

                                        $verif_affectation = IntervenantPhase::where('phase_id', $next_phase->id)->where('intervenant_id', $next_phase->id)->count();

                                        if ($verif_affectation == 0) {
                                            $passage_success = IntervenantPhase::firstOrCreate([
                                                'intervenant_id' => $intervenantId,
                                                'phase_id' => $next_phase->id,
                                                'coupon' => $couponPhase
                                            ]);
                                        } else {
                                            $intervenant_coupon_update = DB::table('intervenant_phases')
                                                ->where('phase_id', 0)
                                                ->where('intervenant_id', $next_phase->id)
                                                ->update(['coupon' => $couponPhase]);
                                        }
                                    }
                                }
                            }
                            break;
                        }
                    }
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

    public function lancerPhase(Request $request)
    {
        // dd($request->id);
        // dd(request());
        $phase = Phase::where('id', $request->id)->where('statut', '!=', 'En cours')->where('statut', '!=', 'Cloturer')->first();
        // dd($phase); 
        if ($phase != null) {
            $phase_statut_update = DB::table('phases')
                ->where('id', $phase->id)
                ->update(['statut' => 'En cours']);
            return back()->with("success", "Phase lancée avec succes");
        } else {
            $phase = Phase::where('id', $request->id)->where('statut', 'Cloturer')->first();

            if ($phase == null) {
                return back()->with("success", "Phase a déjà été lancée avec succes");
            } else {
                return back()->with("success", "Phase est déjà cloturée");
            }
        }
    }
    public function closePhase(Request $request)
    {
        // dd($request->all());
        //  pourcentageMin  "nbr_retenu"  => "5" ceci equivaut au pourcentage minimum de l'intervenant
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

            usort($intervenant_resultat, function ($a, $b) {
                return $b['pourcentage'] - $a['pourcentage'];
            });

            $event = Phase::where('evenement_id', $phase[0]->evenement->id)->get();
            // $total_intervenant = count($intervenant_resultat);
            $interv_retenu_passage = [];
            // $tous = "";
            foreach ($intervenant_resultat as $k => $v) {
                // dd($v["pourcentage"], $k, $intervenant_resultat[$k]);
                if ($v["pourcentage"] >= $request->nbr_retenu) {
                    array_push($interv_retenu_passage, $intervenant_resultat[$k]);
                }
            }
            // dd($interv_retenu_passage, $intervenant_resultat);
            // if ($total_intervenant >= $request->nbr_retenu) {
            //     for ($i = 0; $i < $request->nbr_retenu; $i++) {
            //         $intervenant_resultat[$i];
            //         array_push($interv_retenu_passage, $intervenant_resultat[$i]);
            //     }
            //     $tous = "non";
            // } else {
            //     $tous = 'oui';
            //     for ($i = 0; $i < $total_intervenant; $i++) {
            //         $intervenant_resultat[$i];
            //         array_push($interv_retenu_passage, $intervenant_resultat[$i]);
            //     }
            // }

            $next_phase = "c'est la derniere phase enregistree pour cet evenement";
            $next_phase_cle = "";
            foreach ($event as $key => $val) {
                if ($val->id == $phase[0]->id) {
                    if ($key + 1 < count($event)) {
                        $next_phase_cle = $key + 1;
                        $next_phase = $event[$next_phase_cle];

                        foreach ($interv_retenu_passage as $intervenant) {
                            $slug = $next_phase->slug;

                            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersNumber = strlen($characters);
                            $codeLength = 3;
                            $coupon = null;

                            $getIntervenant = Intervenant::where('email', $intervenant['email'])->first();

                            if ($getIntervenant) {
                                $intervenantId = $getIntervenant->id;
                                do {
                                    $coupon = '';
                                    for ($i = 0; $i < $codeLength; $i++) {
                                        $position = mt_rand(0, $charactersNumber - 1);
                                        $coupon .= $characters[$position];
                                    }
                                } while (IntervenantPhase::where('coupon', $coupon)->exists());

                                $couponPhase = $slug . $coupon;

                                $verif_affectation = IntervenantPhase::where('phase_id', $next_phase->id)->where('intervenant_id', $next_phase->id)->count();

                                if ($verif_affectation == 0) {
                                    $passage_success = IntervenantPhase::firstOrCreate([
                                        'intervenant_id' => $intervenantId,
                                        'phase_id' => $next_phase->id,
                                        'coupon' => $couponPhase
                                    ]);
                                } else {
                                    $intervenant_coupon_update = DB::table('intervenant_phases')
                                        ->where('phase_id', 0)
                                        ->where('intervenant_id', $next_phase->id)
                                        ->update(['coupon' => $couponPhase]);
                                }
                            }
                        }
                    }
                    break;
                }
            }
            $phase_intervenant_update = DB::table('phases')
                ->where('id', $phase[0]->id)
                ->update(['statut' => 'cloturer']);

            // dd($intervenant_resultat, $request->nbr_retenu,$interv_retenu_passage,$tous,$total_intervenant,$next_phase);

            return back()->with("success", "Phase cloturée avec succes");
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

        if ($phaseStart->type == 'Vote' || $phaseStart->type == 'vote') {
            $phaseStart->passation_nombre = $passNumber;
            $phaseStart->update();
        } else {
            $phaseStart->passation_pourcent = $passPourcent;
            $phaseStart->update();
        }

        return redirect(route('phase.show', $phaseId))->with('successCand', 'La passation à la phase suivante enregistrée avec succès');
    }


    public function detailQuestion(Request $request)
    {

        $id = $request->id;
        $phase_id = $request->phase_id;
        $question_verif = QuestionPhase::where('question_id', $id)->where('phase_id', $phase_id)->first();
        // dd($question_verif);
        if ($question_verif != null) {
            $question = $question_verif;
            return view('phases.appercuQuestion', compact('question'));
        } else {
            return back()->with('success', "Un erreur inattendue s'est produite avec l'affectation de la question dans la phase");
        }
    }

    public function updateQuestion(Request $request)
    {
        // dd($request->all());
        $question = $request->question;
        $ponderation = $request->ponderation;
        $ponderation_ass = 0;
        $assertions = $request->assertions;
        $reponse = $request->bonneReponse;

        $message_question = "Mise à jour de question a échouée";
        $message_ponderation = "Mise à jour de pondération a échouée";
        $nbre_ass_echec = 0;
        $plus = "";
        $message_assertion = "Mise à jour d'assertion a échouée";

        foreach ($question as $k => $v) {
            $verif_qst = Question::where('id', $k)->first();
            if ($verif_qst != null) {
                $question_update = Question::where('id', $k)->update(['question' => $v]);
                if ($question_update > 0) {
                    $message_question = "Question mise à jour avec success";
                }

                foreach ($ponderation as $key => $value) {
                    $verif_qst_pha_pond = QuestionPhase::where('id', $key)->where('question_id', $k)->first();
                    if ($verif_qst_pha_pond != null) {
                        $updat_ponderation = QuestionPhase::where('id', $key)->where('question_id', $k)->update(['ponderation' => $value]);
                        if ($updat_ponderation > 0) {
                            $message_ponderation = "Ponderation de la question mise à jour avec succes";
                        }
                    }
                }

                foreach ($assertions as $c => $val) {
                    $assertion_verif = Assertion::where('id', $c)->where('question_id', $k)->first();
                    if ($assertion_verif != null) {
                        if ($c == $reponse) {
                            $ponderation_ass = 1;
                        }
                        $assertion_update = Assertion::where('id', $c)->where('question_id', $k)->update(['assertion' => $val, 'ponderation' => $ponderation_ass]);
                        if ($assertion_update > 0) {
                            $message_assertion = "Assertion mise à jour avec succes";
                        } else {
                            $nbre_ass_echec += 1;
                            ($nbre_ass_echec > 1) ? $plus = "s" : null;
                            $message_assertion = "Mise à jour de $nbre_ass_echec assertion$plus a échouée";
                        }
                        $ponderation_ass = 0;
                    }
                }
            }
        }
        // $message = [
        //     "question"=>$,
        //     "assertion"=>$,

        // ];
        return back()->with('success', 'Mise à jour effectué avec succes');
    }
}
