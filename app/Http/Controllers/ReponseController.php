<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Http\Requests\StoreReponseRequest;
use App\Http\Requests\UpdateReponseRequest;
use App\Models\Assertion;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Models\QuestionPhase;
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
                'assertions.*')
            // ->where('questions.statut','=','valide')
            // ->where('assertions.statut','=','active')
            ->get();

        $phase=4;
        $question=1;
        $assertion=5;
    
        return view("reponses.index", compact('questionAssertion'));
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
    public function store(StoreReponseRequest $request)
    {
        $reponse = $request->id_collection_keyQuestion_valAssertion;
        $intervenant = $request->intervenant_id;
        $user_existe = DB::table('reponses')
                    ->where('candidat_id',$intervenant)
                    ->count();
               
        if($user_existe>0){
            return Redirect::back()->with('success',"Merci d'avoir participé !");
        }else{
              $phase_id=$request->phase_id;
            if(!empty($reponse)){
                foreach ($reponse as $key => $value) { 
                    $question_id = $key;
                    $assertion_id = $value;
                                        
                    $ponderationQuestion = DB::table('question_phases')
                                        ->select('ponderation')
                                        ->where('question_id',$question_id)
                                        ->where('phase_id',$phase_id)
                                        ->get();
                    $allAssertionQuestion = DB::table('assertions')
                                        ->select('id','ponderation')
                                        ->where('question_id',$question_id)
                                        ->get();
                    
                    $tabPonderation = array();
                    foreach ($allAssertionQuestion as $key => $value) {
                        array_push($tabPonderation,$value->ponderation);
                    }
                    
                    $maxAssertion = max($tabPonderation); 
                    
                    $ponderationAssertionChoisie = DB::table('assertions')
                                                ->select('ponderation')
                                                ->where('id',$assertion_id)
                                                ->get();
                    //traitement pour trouver cote
                    $Pdq=$ponderationQuestion[0]->ponderation;
                    $Pda=$ponderationAssertionChoisie[0]->ponderation;
                    // dd($maxAssertion, $ponderationAssertionChoisie, $Pdq);
                    $cote=round($Pdq*$Pda/$maxAssertion,2);//on prend 2 rangs apres la virgule
                    //sauvegarde dans la base de donnees
                    $saveReponse=Reponse::firstOrCreate([
                        'question_id'=> $question_id,
                        'candidat_id'=> $intervenant,
                        'cote'=> $cote,
                    ]);
                }
                return Redirect::back()->with('success',"Merci d'avoir répondu et Felicitation!");
            }else{
                return Redirect::back()->with('success',"Merci d'avoir participé !");
            }
        }
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
