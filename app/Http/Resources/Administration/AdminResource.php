<?php

namespace App\Http\Resources\Administration;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'role' => $this->relationLoaded('role') ? $this->role?->{FieldName::NOM} : null,
            FieldName::TELEPHONE => $this->{FieldName::TELEPHONE},
            FieldName::STATUT => $this->{FieldName::STATUT} ? 'Actif' : 'Désactivé',
            FieldName::DERNIERE_CONNEXION => $this->{FieldName::DERNIERE_CONNEXION}, 
        ];
    }
}
