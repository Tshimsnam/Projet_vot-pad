<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JuryPhase extends Model
{
    use HasFactory;
    protected $fillable = [
        'phase_id',
        'jury_id',
        'type',
        'ponderation_prive',
        'ponderation_public',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jury_id' => 'json',
    ];
    
    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

    public function jury(): BelongsTo
    {
        return $this->belongsTo(Jury::class);
    }
}
