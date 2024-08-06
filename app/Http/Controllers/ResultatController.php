<?php

namespace App\Http\Controllers;

use App\Models\IntervenantPhase;
use App\Models\Phase;
use App\Models\QuestionPhase;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ResultatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
       $phase = Phase::where('type','=','evaluation')->get();//recuper phase du type evaluation
      
       $intervenant_phase=array();
       $tableau=array();
       foreach ($phase as $key => $value) {
           $intervant = IntervenantPhase::where('phase_id','=',$value->id)->count();
           $tableau['phase']=['nom'=>$value->nom,'id'=>$value->id];//tabeau pour renseigner phase
           $tableau['inter']=[$intervant];//tabeau pour rensiegner le nombre d'intervenant
           array_push($intervenant_phase, $tableau);
       }
    //    dd($intervenant_phase);
        return view('resultats.index', compact('phase','intervenant_phase'));
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
        $phase = Phase::where('id','=',$id)->where('type','=','evaluation')->get();//recuper phase du type evaluation
        if($phase){

            $question = QuestionPhase::where('phase_id','=',$phase[0]->id)->get();
            $somme_ponderation_phasae = 0;
            foreach($question as $cle => $valeur){
                    $ponde = $valeur->ponderation;
                    $somme_ponderation_phasae+=$ponde;
            }
            $somme_ponderation_phasae;

            $intervenant_resultat = array();
            $tableau=array();
            $intervants = DB::table('intervenants')
                        ->join('intervenant_phases', "intervenant_phases.intervenant_id", "=", "intervenants.id")
                        ->select(
                            'intervenants.id as id',
                            'intervenants.email as email',
                        )
                        ->where("intervenant_phases.id", "=", $phase[0]->id)
                        ->get();
            
                foreach($intervants as $key => $value){
                    $point_inter = 0;
                    $cote = Reponse::where('phase_id','=',$phase[0]->id)->where('intervenant_id','=',$value->id)->get();
                    foreach($cote as $k => $v){
                        $point_inter += $v->cote;
                    }
                    
                    $pourcentage_interv = ( $point_inter/$somme_ponderation_phasae)*100;
                    
                    $pourcentage = round($pourcentage_interv,2);

                    $tableau['id'] = $value->id;
                    $tableau['email'] = $value->email;
                    $tableau['pourcentage'] = $pourcentage;
                    array_push($intervenant_resultat, $tableau);
                    
                }
                // dd($intervenant_resultat);
            return view('resultats.index', compact('intervenant_resultat'));
            
        }else{
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
}
