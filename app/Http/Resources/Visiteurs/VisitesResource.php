<?php

namespace App\Http\Resources\Visiteurs;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            FieldName::ID => $this->{FieldName::ID},
            FieldName::EPASS_ID => $this->relationLoaded('epass')? $this->epass : null,
            FieldName::SITE_ID => $this->relationLoaded('siteTouristique') ? $this->siteTouristique : null,
            FieldName::VISITEUR_ID => $this->relationLoaded('visiteur')? $this->visiteur : null,
            FieldName::DATE_VISITE => $this->{FieldName::DATE_VISITE}?->format('Y-m-d'),
            FieldName::STATUT => $this->{FieldName::STATUT},
        ];
    }
}
