<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionPhaseResource;
use App\Models\Assertion;
use App\Models\IntervenantPhase;
use App\Models\Phase;
use App\Models\QuestionPhase;
use App\Models\Reponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question= QuestionPhase::all();
        return response()->json($question);
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
    public function shows(int $phase, int $intervenant)
    {
        // dd($phase,$intervenant);
        $debut_evaluation   = Carbon::now();
        $heure0             = $debut_evaluation->format('Y-m-d H:i:s');

        $veri_phase = Phase::where("id", $phase)->first();

        if($veri_phase){

            $verif_interv_affectation = IntervenantPhase::where('phase_id',$veri_phase->id)->where('intervenant_id',$intervenant)->first();
           
            if($verif_interv_affectation){

                $timing = $veri_phase->duree;
                $tabtimefin = explode(":",$timing);
                $heurefin =  $debut_evaluation->addHours((int)$tabtimefin[0])->addMinutes((int)$tabtimefin[1])->addSeconds((int)$tabtimefin[2]);
                
                $int_deja_repondu = Reponse::where('phase_id','=',$veri_phase->id)->where('intervenant_id','=',$intervenant)->count();

                if($int_deja_repondu == 0){

                   $verif_heure = DB::table('intervenant_phases')
                                                    ->select('debut_evaluation','fin_evaluation')
                                                    ->where('phase_id', $veri_phase->id)
                                                    ->where('intervenant_id',$intervenant)
                                                    ->get();
                     $getheure=$verif_heure[0]->debut_evaluation;
                     if($getheure == null ){
                        $intervenant_update = DB::table('intervenant_phases')
                                            ->where('phase_id', $veri_phase->id)
                                            ->where('intervenant_id',$intervenant)
                                            ->update(['debut_evaluation' =>  $heure0, 'fin_evaluation' =>$heurefin->format('Y-m-d H:i:s')]);

                        $duree_evaluation = $timing;
                        $data = ['duree'=>$duree_evaluation,'questionaire'=> QuestionPhaseResource::collection(QuestionPhase::where('phase_id','=',$phase)->get())];
                        return  $data;
                    }else{
                        $dateNow = Carbon::now();
                        $dateA = Carbon::create($verif_heure[0]->fin_evaluation); //heure de fin en format date
                        $dateB = Carbon::create($dateNow->format('Y-m-d H:i:s')); // heure de reconnexion en format date
                        
                        $reste = $dateA->diff($dateB);

                        if($reste->invert <= 0){
                            return response()->json(['message'=>'votre evaluation a pris fin'],400);
                        }else{

                            $duree_evaluation = $reste->format('%H:%I:%S');
                            $data = ['duree'=>$duree_evaluation,'questionaire'=> QuestionPhaseResource::collection(QuestionPhase::where('phase_id','=',$phase)->get())];
                            return  $data;
                        }
                    }

                }else{

                    return response()->json(['message'=>'vous avez déjà passé cetteevaluation'],400);
                }


            }else{

                return response()->json(['message'=>'une erreur est survenue lors de l affectation de l intervenant'],400);
            }
        }else{

            return response()->json(['message'=>'la phase inseree est invalide'],400);
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
