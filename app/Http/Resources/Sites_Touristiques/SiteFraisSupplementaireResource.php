<?php

namespace App\Http\Resources\Sites_Touristiques;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteFraisSupplementaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            FieldName::LIBELLE => $this->{FieldName::LIBELLE},
            FieldName::MONTANT => (float) $this->{FieldName::MONTANT},
            FieldName::PAR_EPASS => $this->{FieldName::PAR_EPASS}? 'Par E-pass' : 'Par visiteur',
        ];
    }
}
