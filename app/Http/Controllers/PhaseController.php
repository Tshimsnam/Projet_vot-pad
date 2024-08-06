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
                $groupe = Groupe::find($intervenant->groupe_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenant->nom_groupe = $groupe->nom;
                $intervenant->image = $groupe->image;
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
            return view('criteres.index', compact('criteres', 'phaseCriteres', 'phases', 'phase_id', 'intervenants', 'intervenantPhases', 'jurys', 'juryPhases', 'ponderation_public', 'ponderation_prive', 'type_vote', 'status_phase', 'passNumber'));
        } else {
            // module phase evaluation
            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->latest()->paginate(10);
            $intervenants = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenants[] = $intervenant;
            }
            return view('phases.show', compact('phaseShow', 'question', 'questionAssert', 'intervenants', 'intervenantPhases'));
        }
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

            $intervenantPhases = IntervenantPhase::where('phase_id', $phaseId)->latest()->paginate(10);
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
