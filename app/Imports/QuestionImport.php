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
            //dd ( $questions['ponderation']);
            // dd($questions['reponse']);
            // dd($questions, $key);
            // $assertions = explode( ', ',$questions["assertions"]);
            $question = Question::firstOrCreate([
                'question' => $questions["question"]
            ]);

            $assertions=[
                 $questions['assertion1'],
                $questions['assertion2'],
                $questions['assertion3'],
                $questions['assertion4'],
                $questions['assertion5'] 
            ];
            // dd($assertions_tab);
            $ponde_asser = 0;
            foreach($assertions as $assertion){
                if($assertion==$questions['reponse'])
                {
                    $ponde_asser = 1;
                }
                // dd($assertion, $ponde_asser);
                if($assertion!=""){
                    $assertion = Assertion::firstOrCreate([
                        'question_id' => $question->id,
                        'assertion' => $assertion,
                        'ponderation' => $ponde_asser,
                        'statut' => "ok"
                    ]);
                }
                $ponde_asser = 0;
                //dd($assertion, $questions['reponse'],$ponde_asser);
            }
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
