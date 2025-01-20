<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreReponseRequest;
use App\Http\Requests\UpdateReponseRequest;
use App\Models\IntervenantPhase;
use App\Models\Phase;
use App\Models\Reponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $question= Question::orderBy("id","desc")->paginate(1);
        // $assertion=Assertion::orderBy("id","desc")->where("question_id",)->get();

        $questionAssertion = DB::table('assertions')
            ->join('questions', 'assertions.question_id', '=', 'questions.id')
            ->select(
                // 'questions.id as question_id',
                // 'questions.ponderation as question_ponderation',
                // 'questions.question as question',
                // 'questions.statut as quest_stat',
                'assertions.*'
            )
        // ->where('questions.statut','=','valide')
        // ->where('assertions.statut','=','active')
            ->get();
        $phaseId = session('phase_id');
        $phase   = Phase::find($phaseId);

        $intervenantId = session('intervenant_id');

        $intervenantPhase   = IntervenantPhase::where('intervenant_id', $intervenantId)->where('phase_id', $phaseId)->first();
        $fin_evaluation     = $intervenantPhase->fin_evaluation;
        $valider_evaluation = $intervenantPhase->terminer;
        $date_carbon        = Carbon::now();
        $date_actuelle      = $date_carbon->format('Y-m-d H:i:s');
        if (($date_actuelle > $fin_evaluation && $fin_evaluation != null) || $valider_evaluation != null) {
            return redirect(route('form-authenticate'))->with('unsuccess', 'Désolé(e), vous avez déjà passé l\'évaluation.');
        }
        return view("reponses.index", compact('questionAssertion', 'phase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phaseId = session('phase_id');
        $phase   = Phase::find($phaseId);

        $intervenantId = session('intervenant_id');

        $intervenantPhase   = IntervenantPhase::where('intervenant_id', $intervenantId)->where('phase_id', $phaseId)->first();
        $fin_evaluation     = $intervenantPhase->fin_evaluation;
        $valider_evaluation = $intervenantPhase->terminer;
        $date_carbon        = Carbon::now();
        $date_actuelle      = $date_carbon->format('Y-m-d H:i:s');
        if (($date_actuelle > $fin_evaluation && $fin_evaluation != null) || $valider_evaluation != null) {
            return redirect(route('form-authenticate'))->with('unsuccess', 'Désolé(e), vous avez déjà passé l\'évaluation.');
        }
        return view('reponses.index', compact('phase'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReponseRequest $request)
    {
        $message = "Merci d'avoir répondu et Felicitation!";

        $reponse     = $request->id_collection_keyQuestion_valAssertion;
        $intervenant = $request->intervenant_id;
        $phase       = $request->phase_id;
        $user_existe = DB::table('reponses')
            ->where('intervenant_id', $intervenant)
            ->where('phase_id', $phase)
            ->count();
        // if ($user_existe > 0) {
        //     session([
        //         'phase'       => $request->phase_id,
        //         'intervenant' => $request->intervenant_id,
        //     ]);
        //     $message = "Merci d'avoir participé !";
        //     return view('intervenants.logout', compact('message'));
        // } else {

        // if (! empty($reponse)) {
        foreach ($reponse as $key => $value) {
            $question_id  = $key;
            $assertion_id = $value;

            $ponderationQuestion = DB::table('question_phases')
                ->select('ponderation', 'id')
                ->where('question_id', $question_id)
                ->where('phase_id', $phase)
                ->get();

            $allAssertionQuestion = DB::table('assertions')
                ->select('id', 'ponderation')
                ->where('question_id', $question_id)
                ->get();

            $tabPonderation = [];
            foreach ($allAssertionQuestion as $key => $value) {
                array_push($tabPonderation, $value->ponderation);
            }

            $maxAssertion = max($tabPonderation);

            $ponderationAssertionChoisie = DB::table('assertions')
                ->select('ponderation', 'id')
                ->where('id', $assertion_id)
                ->get();

            //traitement pour trouver cote
            $Pdq = $ponderationQuestion[0]->ponderation;
            $Pda = $ponderationAssertionChoisie[0]->ponderation;
                                           // dd($maxAssertion, $ponderationAssertionChoisie, $Pdq);
                                           //$cote=round($Pdq*$Pda/$maxAssertion,2); prend 2 rangs apres la virgule
            $cote = ($Pda > 0) ? $Pdq : 0; //la cote est egal au ponderation de la question si la ponderation de l'assertion est 1 ou >0

            $assertion_id      = $ponderationAssertionChoisie[0]->id;
            $question_phase_id = $ponderationQuestion[0]->id;
            //sauvegarde dans la base de donnees

            $saveReponse = Reponse::firstOrCreate([
                'question_phase_id' => $question_phase_id,
                'intervenant_id'    => $intervenant,
                'phase_id'          => (int) $phase,
            ]);

            $saveReponse->assertion_id = $assertion_id;
            $saveReponse->cote = $cote;
            $saveReponse->save();
        }
        session([
            'phase'       => $request->phase_id,
            'intervenant' => $request->intervenant_id,
        ]);
        $intervenantPhase           = IntervenantPhase::where('intervenant_id', $intervenant)->where('phase_id', $phase)->first();
        $intervenantPhase->terminer = 'valider';
        $intervenantPhase->save();
        return view('intervenants.logout', compact('message'));
        // } else {
        //     session([
        //         'phase'       => $request->phase_id,
        //         'intervenant' => $request->intervenant_id,
        //     ]);
        //     $intervenantPhase           = IntervenantPhase::where('intervenant_id', $intervenant)->where('phase_id', $phase)->first();
        //     $intervenantPhase->terminer = 'valider';
        //     $intervenantPhase->save();
        //     $message = "Merci d'avoir participé !";
        //     return view('intervenants.logout', compact('message'));
        // }
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reponse $reponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reponse $reponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReponseRequest $request, Reponse $reponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reponse $reponse)
    {
        //
    }
}
