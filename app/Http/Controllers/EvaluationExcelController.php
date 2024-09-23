<?php

namespace App\Http\Controllers;

use App\Exports\EvaluationExport;
use App\Models\Evenement;
use App\Models\Phase;
use App\Models\QuestionPhase;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EvaluationExcelController extends Controller
{
    public function export_excel($phase_id)
    {
        $phase = Phase::where('id', '=', $phase_id)->where('type', '=', 'evaluation')->get(); //recuper phase du type evaluation
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
                $intervenants = DB::table('intervenants')
                    ->join('intervenant_phases', "intervenant_phases.intervenant_id", "=", "intervenants.id")
                    ->select(
                        'intervenants.id as id',
                        'intervenants.email as email',
                        'intervenants.noms as noms',
                        'intervenants.telephone as telephone',
                        'intervenants.genre as genre'
                    )
                    ->where("intervenant_phases.phase_id", "=", $phase[0]->id)
                    ->where("intervenant_phases.token", "<>", 0)  // Condition pour token différent de 0
                    ->get();


                foreach ($intervenants as $key => $value) {
                    $point_inter = 0;
                    $cote = Reponse::where('phase_id', '=', $phase[0]->id)->where('intervenant_id', '=', $value->id)->get();
                    foreach ($cote as $k => $v) {
                        $point_inter += $v->cote;
                    }

                    $pourcentage_interv = ($point_inter / $somme_ponderation_phase) * 100;

                    $pourcentage = round($pourcentage_interv, 2);

                    $tableau['id'] = $value->id;
                    $tableau['email'] = $value->email;
                    $tableau['noms'] = $value->noms;
                    $tableau['telephone'] = $value->telephone;
                    $tableau['genre'] = $value->genre;
                    $tableau['pourcentage'] = $pourcentage;
                    array_push($intervenant_resultat, $tableau);
                }
                // dd($intervenant_resultat);
                usort($intervenant_resultat, function ($a, $b) {
                    return $b['pourcentage'] - $a['pourcentage'];
                });
            }
        }
        $phaseEval = Phase::findOrFail($phase_id);
        $phase_nom = Phase::find($phase_id)->nom;
        $evenement = Evenement::findOrFail($phaseEval->evenement_id);
        $evenement_nom = $evenement->nom;
        return Excel::download(new EvaluationExport($intervenant_resultat, $phase_nom, $evenement_nom), 'rapportEvaluation.xlsx');
    }
}
