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
        foreach($data as $questions){
        //   dd ( $questions['ponderation']);
            // dd($questions['reponse']);
            // dd($questions["assertions"]);
            $assertions = explode( ', ',$questions["assertions"]);
            $ponde_asser = 0;
            // dd($assertions);
            $question = Question::firstOrCreate([
                'question' => $questions["question"]
            ]);
            foreach($assertions as $assertion){
                if($assertion==$questions['reponse'])
                {
                    $ponde_asser = 1;
                }
                $assertion = Assertion::firstOrCreate([
                    'question_id' => $question->id,
                    'assertion' => $assertion,
                    'ponderation' => $ponde_asser,
                    'statut' => "ok"
                ]);
                $ponde_asser = 0;
                //dd($assertion, $questions['reponse'],$ponde_asser);
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
}
