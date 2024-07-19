<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntervenantPhaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->intervenantPhaseId,
                'phase_id' => $this->phaseId,
                'intervenant' => $this->id,
                'phase_nom' => $this->phase_nom,
                'email' => $this->email,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'token' => $this->intervenantToken
            ];
    }
}
