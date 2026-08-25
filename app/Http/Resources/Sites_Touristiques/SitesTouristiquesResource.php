<?php

namespace App\Http\Resources\Sites_Touristiques;
use App\Lib\FieldName;
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
            FieldName::CREATED_BY => $this->{FieldName::CREATED_BY},
            FieldName::ACTEUR_MOBILE_ID => $this->{FieldName::ACTEUR_MOBILE_ID},
            FieldName::OUVERT_24_7 => $this->{FieldName::OUVERT_24_7},
            FieldName::TYPE_TARIFICATION => $this->{FieldName::TYPE_TARIFICATION},
        ];
    }
}