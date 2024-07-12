<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;
    protected $fillable = [
        "cote",
        "assertion_id",
        "intervenant_id",
        "question_phase_id",
        "phase_id"
    ] ;

    public function question_phase(){
        return $this->belongsTo(QuestionPhase::class);
    }
    public function intervenant(){
        return $this->belongsTo(Intervenant::class);
    }
    public function assertion(){
        return $this->belongsTo(Assertion::class);
    }
}
