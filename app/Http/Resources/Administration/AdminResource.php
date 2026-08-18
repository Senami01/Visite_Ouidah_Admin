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
            FieldName::ID => $this->{FieldName::ID},
            FieldName::NOM => $this->{FieldName::NOM},
            FieldName::PRENOM => $this->{FieldName::PRENOM},
            FieldName::TELEPHONE => $this->{FieldName::TELEPHONE},
            FieldName::EMAIL => $this->{FieldName::EMAIL},
            FieldName::ROLE_ID => $this->{FieldName::ROLE_ID},
            FieldName::TYPE => $this->{FieldName::TYPE},
            FieldName::TYPE_ACTEUR => $this->{FieldName::TYPE_ACTEUR},
            'role' => $this->relationLoaded('role') ? $this->role : null,
        ];
    }
}
