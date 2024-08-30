<?php

namespace App\Http\Controllers;

use App\Models\IntervenantPhase;
use App\Models\QuestionPhase;
use App\Http\Requests\StoreQuestionPhaseRequest;
use App\Http\Requests\UpdateQuestionPhaseRequest;
use App\Models\Assertion;
use App\Models\Intervenant;
use App\Models\Phase;
use App\Models\Reponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class QuestionPhaseController extends Controller
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
    public function store(StoreQuestionPhaseRequest $request)
    {
         $request->validated([
           'phase_id'=>'require',
            'question_id'=> 'require',
            'ponderation'=> 'require'
        ]);
        if(isEmpty($request->question_id)) {return back()->with("echec","Cette question n'existe pas, prière de la créer"); }else{
        DB::connection()->enableQueryLog();
        $verif=QuestionPhase::all()->where("phase_id", $request->phase_id);//on recupere tout dans question phase et on verifie si l'enregistrement existe deja
        $tabQuestion=array();
        foreach ($verif as $key => $value) {
           $verif2= $value->question_id;
          array_push($tabQuestion, $verif2);
        }
        if(in_array($request->question_id, $tabQuestion)){
            return back()->with("echec","Question existe dja dans cette phase"); 
            }else{
                $questionPhase = QuestionPhase::firstOrCreate([
                    "phase_id"=> $request->phase_id,
                    "question_id"=> $request->question_id,
                    "ponderation"=> $request->ponderation
                ]);
                $questionPhase->save();
                return back()->with("success","Question enregistrée avec succes"); 
        }
    }
            
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionPhase $questionPhase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionPhase $questionPhase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionPhaseRequest $request, QuestionPhase $questionPhase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionPhase $questionPhase)
    {
        //
    }
    public function questionPhase(Request $request){

        $debut_evaluation   = Carbon::now();
        $heure0             = $debut_evaluation->format('Y-m-d H:i:s');
        // dd($heure);
        $phase= Phase::where("id", $request->phase_id)->first();
        
        if($phase){

            $question= QuestionPhase::orderBy('id')
            ->select('question_id')
            ->where("phase_id", $request->phase_id)
            ->get();//recupere toutes les questions

            $questionAssetionTab=array();
            $tableau=array();
            foreach ($question as $key => $value) {
                $assertion= Assertion::orderBy('id')->select('id','assertion','question_id')->where("question_id", $value->question_id)->get();
                $tableau['question']=['question'=>$value->question->question,'id'=>$value->question->id];//tabeau pour question
                $tableau['assertion']=[$assertion];//tabeau pour assertion
                array_push($questionAssetionTab, $tableau);
            }
            shuffle($questionAssetionTab);
    
            foreach ($questionAssetionTab as $key => $value) {
                //value a deux tableaux [question] et [assertion] mais assertion un objet
                $tabAsseetionSimplifier=array();
                foreach ($value['assertion'] as $key2 => $assertions) {
                        foreach ($assertions as $var) {
                            $varAss['assertion']= $var->assertion;
                            $varAss['id']= $var->id;
                            $varAss['ponderation']= $var->ponderation;
                            array_push($tabAsseetionSimplifier,$varAss);
                        }
                }
                
            }
            
            $timing = $phase->duree;
            $tabtimefin = explode(":",$timing);
            $heurefin =  $debut_evaluation->addHours((int)$tabtimefin[0])->addMinutes((int)$tabtimefin[1])->addSeconds((int)$tabtimefin[2]);
          
            $interven = IntervenantPhase::where('intervenant_id','=',$request->intervenant_id)->where('phase_id','=',$request->phase_id)->count();
            if($interven>0){
                $int_deja_repondu = Reponse::where('phase_id','=',$request->phase_id)->where('intervenant_id','=',$request->intervenant_id)->count();
               
                if($int_deja_repondu == 0){

                    $interv_phase= DB::table('intervenant_phases')
                                    ->select('debut_evaluation', 'fin_evaluation')
                                    ->where('phase_id', $request->phase_id)
                                    ->where('intervenant_id',$request->intervenant_id)
                                    ->get();
                
                    if($interv_phase->count()>0){
                        $debut_enreg=$interv_phase[0]->debut_evaluation;
                        if($debut_enreg==null){
                            
                            $intervenant_update = DB::table('intervenant_phases')
                                                    ->where('phase_id', $request->phase_id)
                                                    ->where('intervenant_id',$request->intervenant_id)
                                                    ->update(['debut_evaluation' =>  $heure0, 'fin_evaluation' =>$heurefin->format('Y-m-d H:i:s')]);
                            $verif_heure= DB::table('intervenant_phases')
                                                    ->select('debut_evaluation')
                                                    ->where('phase_id', $request->phase_id)
                                                    ->where('intervenant_id',$request->intervenant_id)
                                                    ->get();
                            $getheure=$verif_heure[0]->debut_evaluation;   
                            //  dd($getheure);
                            if($getheure != null ){
                                $duree_evaluation = $timing;
                                $debut_evaluation_enreg =$getheure;
                                // dd("il vient de commencer à $getheure duree total evaluation  $timing ");  
                                session(['phaseId'      => $request->phase_id,
                                        'intervenantId' =>$request->intervenant_id]);
                                return Redirect::back()
                                        ->with('success','Bonne chance')
                                        ->with('debut',"C'est parti")
                                        ->with(compact('questionAssetionTab','phase','duree_evaluation','debut_evaluation_enreg'));
                            } else{
                                $duree_evaluation = null;
                                // dd("echec erreur, $duree_evaluation");
                                return Redirect::back()
                                        ->with('success',"Une erreur s'est produite !");
                            }                 
                        }else{

                            $dateNow = Carbon::now();
                            $dateA = Carbon::create($interv_phase[0]->fin_evaluation); //heure de fin en format date
                            $dateB = Carbon::create($dateNow->format('Y-m-d H:i:s')); // heure de reconnexion en format date

                            // Calculer la différence entre les deux dates
                            $reste = $dateA->diff($dateB);
                            // dd($dateA,$dateB,$reste->invert);
                            if($reste->invert <= 0){
                                session(['phaseId' => $request->phase_id,
                                'intervenantId'=>$request->intervenant_id]);
                                return Redirect::back()
                                        ->with('success',"Votre evaluation a pris fin, merci d'avoir participé !");
                                        
                            }else{
                                $duree_evaluation = $reste->format('%H:%I:%S');
                                // dd($reste->format('%H:%I:%S'));
                                // dd("Il a deja commencé et fin dans $reste");
                                $verif_heure      = DB::table('intervenant_phases')
                                                    ->select('debut_evaluation')
                                                    ->where('phase_id', $request->phase_id)
                                                    ->where('intervenant_id',$request->intervenant_id)
                                                    ->get();
                                $debut_evaluation_enreg = $verif_heure[0]->debut_evaluation;   
                                session(['phaseId' => $request->phase_id,
                                'intervenantId'=>$request->intervenant_id]);
                                return Redirect::back()
                                        ->with('success','Bonne chance')
                                    ->with('debut',"C'est parti")
                                    ->with(compact('questionAssetionTab','phase','duree_evaluation','debut_evaluation_enreg'));
                            }
                        }

                    } else{
                        //  dd("echec, cet intervenant n'a pas acces à cette evaluation");
                        return Redirect::back()
                        ->with('success',"echec, cet intervenant n'a pas acces à cette evaluation");
                    }
                   
                }else{
                    session(['phaseId' => $request->phase_id,
                    'intervenantId'=>$request->intervenant_id]);
                    return Redirect::back()
                    ->with('success','Vous avez déjà passé cette évaluation');
                }
            }else{
                    session(['phaseId' => $request->phase_id,
                            'intervenantId'=>$request->intervenant_id]);
                    return Redirect::back()
                    ->with('success','Intervenant invalide');
            }
        }else{
            session(['phaseId' => $request->phase_id,
                    'intervenantId'=>$request->intervenant_id]);
            return Redirect::back()
            ->with('success','Phase invalide');
        }
        
    }
}
