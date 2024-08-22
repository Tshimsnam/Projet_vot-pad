<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class IntervenantPhase extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'intervenant_id',
        'coupon',
        'phase_id',
        'statut'
    ];
    public function intervenant(): BelongsTo
    {
        return $this->belongsTo(Intervenant::class);
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }
}
