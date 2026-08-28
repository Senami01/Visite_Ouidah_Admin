<?php

namespace App\Http\Resources\Sites_Touristiques;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteHoraireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            FieldName::JOUR => $this->{FieldName::JOUR},
            FieldName::OUVERTURE => $this->{FieldName::OUVERTURE},
            FieldName::FERMETURE => $this->{FieldName::FERMETURE},
        ];
    }
}
