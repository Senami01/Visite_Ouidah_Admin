<?php

namespace App\Http\Resources\UtilisateursMobile;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UtilisateursMobileResource extends JsonResource
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
            FieldName::EMAIL => $this->{FieldName::EMAIL},
            FieldName::TELEPHONE => $this->{FieldName::TELEPHONE},
            FieldName::ACTEUR_MOBILE_ID => $this->{FieldName::ACTEUR_MOBILE_ID},
            FieldName::PAYS => $this->{FieldName::PAYS},
            FieldName::ROLE => $this->{FieldName::ROLE},
            FieldName::STATUT => $this->{FieldName::STATUT}, 
        ];
    }
}
