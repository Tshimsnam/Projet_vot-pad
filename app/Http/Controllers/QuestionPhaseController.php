<?php

namespace App\Http\Controllers;

use App\Models\IntervenantPhase;
use App\Models\QuestionPhase;
use App\Http\Requests\StoreQuestionPhaseRequest;
use App\Http\Requests\UpdateQuestionPhaseRequest;
use App\Models\Assertion;
use App\Models\Intervenant;
use App\Models\Phase;
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
        $heure              = $debut_evaluation->format('H:i:s');
        $phase= Phase::where("id", $request->phase_id)->first();
        if($phase){
            $interven = IntervenantPhase::where('intervenant_id','=',$request->intervenant_id)->where('phase_id','=',$request->phase_id)->count();
            if($interven>0){
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
        
                    // dd(
                    //         $value['question']['question'],
                    //         $value['question']['id'],
                    //         $value['question']['ponderation'],
                    //         $tabAsseetionSimplifier[0]['id']
                    // );
                    // // dd($questionAssetionTab);
    
        
                session(['phaseId' => $request->phase_id,
                'intervenantId'=>$request->intervenant_id]);
                return Redirect::back()
                        ->with('success','Bonne chance')
                        ->with('debut','C"est parti')
                        ->with(compact('questionAssetionTab','phase'));
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
