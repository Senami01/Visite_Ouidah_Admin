<?php

namespace App\Http\Resources\Visiteurs;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisiteursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            FieldName::NOM => $this->{FieldName::NOM},
            FieldName::PRENOM => $this->{FieldName::PRENOM},
            FieldName::PAYS => $this->{FieldName::PAYS},
            FieldName::TELEPHONE => $this->{FieldName::TELEPHONE},
            'epasses' => $this->epasse_count ?? 0,
            'visites' => $this->visite_count ?? 0,
            'liste_visites' => VisitesResource::collection($this->whenLoaded('visite')),
        ];
    }
}
