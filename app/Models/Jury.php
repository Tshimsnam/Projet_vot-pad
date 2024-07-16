<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class Jury extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'coupon',
        'type',
        'token',
        'is_use',
        'identifiant',
    ];

    public function phases():BelongsToMany
    {
        return $this->BelongsToMany(Phase::class, 'jury_phases');
    }
    public function juryPhases(): HasMany
    {
        return $this->hasMany(JuryPhase::class);
    }
}
