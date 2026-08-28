<?php

namespace App\Http\Resources\Epasses;

use App\Lib\FieldName;
use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class EpassesResource extends JsonResource
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
            FieldName::REFERENCE => $this->{FieldName::REFERENCE},
            FieldName::TYPE_INITIATEUR => $this->{FieldName::TYPE_INITIATEUR},
            FieldName::ACTEUR_MOBILE_ID => $this->relationLoaded('acteurmobile') ? $this->acteurmobile : null,
            FieldName::VISITEUR_ID => $this->relationLoaded('visiteur') ? $this->visiteur : null,
            FieldName::STATUT => $this->{FieldName::STATUT},
            FieldName::MONTANT_HT => (float) $this->{FieldName::MONTANT_HT},
            FieldName::MONTANT_TAXES => (float) $this->{FieldName::MONTANT_TAXES},
            FieldName::MONTANT_TOTAL => (float) $this->{FieldName::MONTANT_TOTAL},
            FieldName::DATE_REALISATION => $this->{FieldName::DATE_REALISATION}?->format('Y-m-d'),
            'lignes' => EpassLigneResource::collection($this->whenLoaded('lignes')),
            'personnes' => EpassPersonneResource::collection($this->whenLoaded('personnes')),
            'taxes' => EpassTaxeResource::collection($this->whenLoaded('taxes')),
        ];
    }
}
