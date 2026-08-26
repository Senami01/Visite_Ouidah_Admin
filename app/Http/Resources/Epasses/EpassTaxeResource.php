<?php

namespace App\Http\Resources\Epasses;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpassTaxeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            FieldName::ID => $this->{FieldName::ID},
            FieldName::EPASS_ID => $this->{FieldName::EPASS_ID},
            FieldName::TAXE_ID => $this->{FieldName::TAXE_ID},
            FieldName::LIBELLE => $this->{FieldName::LIBELLE},
            FieldName::MONTANT => (float) $this->{FieldName::MONTANT},
        ];
    }
}
