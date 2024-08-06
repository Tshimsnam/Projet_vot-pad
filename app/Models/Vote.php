<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'intervenant_phase_id',
        'phase_jury_id',
        'phase_critere_id',
        'cote',
        'nombre',
        'isVerified',
    ];
}
