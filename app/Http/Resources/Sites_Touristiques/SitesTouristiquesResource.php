<?php

namespace App\Http\Resources\Sites_Touristiques;
use App\Lib\FieldName;
use App\Http\Resources\Administration\AdminResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SitesTouristiquesResource extends JsonResource
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
            FieldName::CATEGORIE => $this->{FieldName::CATEGORIE},
            FieldName::LATITUDE => $this->{FieldName::LATITUDE},
            FieldName::LONGITUDE => $this->{FieldName::LONGITUDE},
            FieldName::COURTE_DESCRIPTION => $this->{FieldName::COURTE_DESCRIPTION},
            FieldName::OUVERT_24_7 => $this->{FieldName::OUVERT_24_7},
            FieldName::TYPE_TARIFICATION => $this->{FieldName::TYPE_TARIFICATION},
            FieldName::CREATED_BY          => $this->relationLoaded('administrateur') 
                                                ? new AdminResource($this->admninistrateur) 
                                                : $this->{FieldName::CREATED_BY},    
            FieldName::ACTEUR_MOBILE_ID    => $this->relationLoaded('acteurMobile') 
                                                ? $this->acteurMobile
                                                : $this->{FieldName::ACTEUR_MOBILE_ID},
            'horaires' => SiteHoraireResource::collection($this->whenLoaded('horaires')),
            'medias' => SiteMediaResource::collection($this->whenLoaded('medias')),
            'tarifs' => SiteTarifResource::collection($this->whenLoaded('tarifs')),
            'frais_supplementaires' => SiteFraisSupplementaireResource::collection($this->whenLoaded('fraisSupplementaires')),
        ];
    }
}