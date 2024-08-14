<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IntervenantPhase;
use App\Models\QuestionPhase;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $intervenant = $request->intervenant_id;
        $phase       = $request->phase_id;
        $cote        = $request->cote;
        $message = "Merci d'avoir répondu et félicitations";

        $veri_phase = QuestionPhase::where('phase_id',$phase)->first();
        if($veri_phase){
            $verif_interv_affectation = IntervenantPhase::where('phase_id',$veri_phase->phase_id)->where('intervenant_id',$intervenant)->first();
            if($verif_interv_affectation){ 
                // return response()->json(['message'=>$verif_interv_affectation],400);
                // $verif_deja_repondu = Reponse::where('phase_id',$veri_phase->id)->where('intervenant_id',$verif_interv_affectation->id);
                foreach($cote as  $value){
                    $question = $value['question_id'];
                    $assertion = $value['assertion_id'];
                
                    $ponderationQuestion = DB::table('question_phases')
                                                    ->select('ponderation','id')
                                                    ->where('question_id',$question)
                                                    ->where('phase_id',$phase)
                                                    ->get();
                    $allAssertionQuestion = DB::table('assertions')
                                                    ->select('id','ponderation')
                                                    ->where('question_id',$question)
                                                    ->where('id',$assertion)
                                                    ->get();  
                    if($allAssertionQuestion->count() == 0){
                        $message = "Pas d'assertion avec cet id, un cas possible de tricherie";
                        return response()->json(['messeage'=>$message]);
                    }else{
                        $ponderationAssertion = $allAssertionQuestion[0]->ponderation;
                        if($ponderationAssertion>0){
                            $cote = $ponderationQuestion[0]->ponderation;
                        }else{
                            $cote = 0;
                        }
                        $question_phase_id = $ponderationQuestion[0]->id;
                        $saveReponse=Reponse::firstOrCreate([
                            'question_phase_id'=> $question_phase_id,
                            'intervenant_id'=> $intervenant,
                            'assertion_id'=>$assertion,
                            'phase_id'=>(int)$phase,
                            'cote'=> $cote,
                        ]);
                        
                    }      
                }
                return response()->json(['messeage'=>$message]);
            }else{
                return response()->json(['message'=>"Intervenant n'est pas affecte dans cette phase"],400);
            }
        
        }else{
            return response()->json(['message'=>'Phase invalide'],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
