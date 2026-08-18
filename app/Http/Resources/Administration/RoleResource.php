<?php

namespace App\Http\Resources\Administration;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            FieldName::DESCRIPTION => $this->{FieldName::DESCRIPTION},
        ];
    }
}
