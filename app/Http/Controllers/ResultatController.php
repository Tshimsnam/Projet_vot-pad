<?php

namespace App\Http\Controllers;

use App\Models\Assertion;
use App\Models\Evenement;
use App\Models\Intervenant;
use App\Models\IntervenantPhase;
use App\Models\Phase;
use App\Models\Question;
use App\Models\QuestionPhase;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ResultatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $phase = Phase::where('type', '=', 'evaluation')->get(); //recuper phase du type evaluation

        $intervenant_phase = array();
        $tableau = array();
        foreach ($phase as $key => $value) {
            $intervant = IntervenantPhase::where('phase_id', '=', $value->id)->count();
            $tableau['phase'] = ['nom' => $value->nom, 'id' => $value->id]; //tabeau pour renseigner phase
            $tableau['inter'] = [$intervant]; //tabeau pour rensiegner le nombre d'intervenant
            array_push($intervenant_phase, $tableau);
        }
        //    dd($intervenant_phase);
        return view('resultats.index', compact('phase', 'intervenant_phase'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $phase_verif = Phase::where('id', '=', $id)->where('type', '=', 'evaluation')->get();

        $evenement = Evenement::findOrFail($phase_verif[0]->evenement_id);
        if ($user->role == 'super-momekano') {
            $phase = $phase_verif;
        } else if ($user->id == $evenement->user_id) {
            $phase = $phase_verif;
        } else {
            return response()->json(['error' => 'Vous n\'avez pas les droits pour accéder à cette page'], 403);
        }


        if ($phase) {

            $question = QuestionPhase::where('phase_id', '=', $phase[0]->id)->get();
            $somme_ponderation_phase = 0;
            foreach ($question as $cle => $valeur) {
                $ponde = $valeur->ponderation;
                $somme_ponderation_phase += $ponde;
            }
            $somme_ponderation_phase;
            if ($somme_ponderation_phase > 0) {

                $intervenant_resultat = array();
                $tableau = array();
                $intervants = DB::table('intervenants')
                    ->join('intervenant_phases', "intervenant_phases.intervenant_id", "=", "intervenants.id")
                    ->select(
                        'intervenants.id as id',
                        'intervenants.email as email',
                        'intervenants.noms as noms',
                    )
                    ->where("intervenant_phases.phase_id", "=", $phase[0]->id)
                    ->get();

                foreach ($intervants as $key => $value) {
                    $point_inter = 0;
                    $cote = Reponse::where('phase_id', '=', $phase[0]->id)->where('intervenant_id', '=', $value->id)->get();
                    if (count($cote) > 0) {
                        $msg = 1;
                    } else {
                        $msg = null;
                    }
                    foreach ($cote as $k => $v) {
                        $point_inter += $v->cote;
                    }

                    $pourcentage_interv = ($point_inter / $somme_ponderation_phase) * 100;

                    $pourcentage = round($pourcentage_interv, 2);

                    $tableau['id'] = $value->id;
                    $tableau['email'] = $value->email;
                    $tableau['noms'] = $value->noms;
                    $tableau['pourcentage'] = $pourcentage;
                    $tableau['evaluee'] = $msg;
                    array_push($intervenant_resultat, $tableau);
                }
                // dd($intervenant_resultat);
                usort($intervenant_resultat, function ($a, $b) {
                    return $b['pourcentage'] - $a['pourcentage'];
                });
                session(['breadPhase' => $phase[0]->id]);
                return view('resultats.index', compact('intervenant_resultat', 'phase', 'evenement'));
            } else {
                return back()->with('success', "Il n'y a pas de question pour cette phase");
            }
        } else {
            return Redirect::back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function resultatDetail($phase_id, $interv_id)
    {

        $phase = Phase::where('id', '=', $phase_id)->get(); //recuper phase
        if ($phase) {

            $question_phases = QuestionPhase::where('phase_id', '=', $phase[0]->id)->get(); //recupere les question de la phase
            $questions = $question_phases;

            $somme_ponderation_phase = 0;
            $tab_question_detail = [];
            foreach ($question_phases as $cle => $valeur) {

                $ponde = $valeur->ponderation;
                $somme_ponderation_phase += $ponde;

                $reponse = Reponse::where('question_phase_id', '=', $valeur->id)->where('intervenant_id', '=', $interv_id)->first();
                if ($reponse != null) {
                    $questions[$cle]->assertion = (!empty($reponse->assertion->assertion)) ? $reponse->assertion->assertion : "assertion inexistante";
                    $questions[$cle]->cote = $reponse->cote;
                    $questions[$cle]->assertion_id = $reponse->assertion_id;
                } else {
                    $questions[$cle]->assertion = "N'a pas repondu ";
                    $questions[$cle]->cote = 0;
                }
                $questions[$cle]->question = $valeur->question->question;



                // $point = 0;
                // $assertion = "N'a pas repondu ";
                // foreach($cote as $ky => $val){
                //     if($val->question_phase->question_id == $valeur->question->id){
                //         $point = $val->cote;
                //         // $verif_ass = Assertion::findOrFail($val->assertion_id);
                //         // dd($verif_ass->assertion);
                //         // if($verif_ass){
                //             $assertion = $val->assertion->assertion;
                //         // }
                //         break;
                //     }
                // }

                // array_push($tab_question_detail, 
                // [
                //     "libele" => $valeur->question->question,
                //     "assertion"=>$assertion,
                //     "cote" => $point,
                //     "ponderation" => $ponde
                // ]);
            }
            // dd($somme_ponderation_phase,$questions);


            $cote = Reponse::where('phase_id', '=', $phase[0]->id)->where('intervenant_id', '=', $interv_id)->get();
            $point_inter = 0;
            foreach ($cote as $k => $v) {
                $point_inter += $v->cote;
            }

            $pourcentage_interv = ($point_inter / $somme_ponderation_phase) * 100;

            $pourcentage = round($pourcentage_interv, 2);

            $tab_synthese = [
                "total_obtenu" => $point_inter,
                "total_phase" => $somme_ponderation_phase,
                "pourcentage" => $pourcentage,
                "intervenant" => $cote[0]->intervenant->email
            ];

            return view('resultats.show', compact('questions', 'phase', 'tab_synthese'));
        } else {
        }
    }
}
