<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Critere;
use App\Models\Question;
use App\Models\Assertion;
use App\Models\Evenement;
use App\Models\Intervenant;
use Illuminate\Http\Request;
use App\Models\QuestionPhase;
use App\Models\IntervenantPhase;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;

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
        $evenement = $evenements;
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
        // $phase->delete();
        // return redirect()->route('phases.index')->with('success','Suppression effectuée avec succès');
        //Je suggere la desactivation de la phase dans le statut
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

            $intervenantPhases = IntervenantPhase::where('phase_id', $phase_id)->latest()->paginate(10);
            $intervenants = [];
            foreach ($intervenantPhases as $intervenantPhase) {
                $intervenant = Intervenant::find($intervenantPhase->intervenant_id);
                $intervenant->intervenantPhaseId = $intervenantPhase->id;
                $intervenants[] = $intervenant;
            }
            $phases = $phaseShow;
            $criteres = Critere::with('phases')->latest()->paginate(13);
            return view('criteres.index', compact('criteres', 'phases', 'phase_id', 'intervenants', 'intervenantPhases'));
        } else {
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
}
