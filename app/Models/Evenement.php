<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'type',
        'date_debut',
        'date_fin',
        'status',
        'user_id',
    ];

    public function phases()
    {
        return $this->hasMany(Phase::class, "evenement_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
