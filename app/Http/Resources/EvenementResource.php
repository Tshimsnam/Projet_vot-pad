<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvenementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'nom'=>$this->nom,
            'description'=>$this->description,
            'type'=>$this->type,
            'date_debut'=>$this->date_debut,
            'date_fin'=>$this->date_fin,
            'status'=>$this->status,
            'phases'=>$this->phases,
            'created_at'=>$this->created_at,
        ];
    }
}
