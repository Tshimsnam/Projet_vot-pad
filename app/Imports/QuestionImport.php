<?php

namespace App\Imports;

use App\Models\Assertion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Question;
use App\Models\QuestionPhase;

class QuestionImport implements ToArray, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function array(array $data)
    {
        // dd(request()->all());
        // dd($data);
        foreach($data as $questions){

            $question = Question::firstOrCreate([
                'question' => $questions["question"]
            ]);

            for($i=1; $i<=20; $i++){
                $ponde_asser = 0;
                $assertion = $questions["assertion$i"] ?? "";

                $cleTrouvee = array_search($assertion, $questions);
                // dd($cleTrouvee);
                if($cleTrouvee==$questions['reponse'])
                {
                    $ponde_asser = 1;
                }
                if($assertion!=""){
                    $assertion = Assertion::firstOrCreate([
                        'question_id' => $question->id,
                        'assertion' => $assertion,
                        'ponderation' => $ponde_asser,
                        'statut' => "ok"
                    ]);
                    // dd($assertion, $ponde_asser);
                }
                $ponde_asser = 0;

            }
            // dd($assertion, $ponde_asser);

            $verif = QuestionPhase::all()->where("phase_id", request()->phase)->where('question_id',$question->id)->count();
                if($verif>0){

                }else{
                    $questionPhase = QuestionPhase::firstOrCreate([
                        "phase_id" => request()->phase,
                        "question_id" => $question->id,
                        "ponderation" =>  $questions['ponderation']
                    ]);
                }
        }
    }
}
