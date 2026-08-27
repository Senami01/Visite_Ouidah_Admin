<?php

namespace App\Http\Resources\Epasses;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpassPersonneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            FieldName::ID => $this->{FieldName::ID},
            FieldName::EPASS_ID => $this->{FieldName::EPASS_ID},
            FieldName::NOM => $this->{FieldName::NOM},
            FieldName::PAYS => $this->{FieldName::PAYS},
            FieldName::TYPE_PIECE => $this->{FieldName::TYPE_PIECE},
            FieldName::NUMERO_PIECE => $this->{FieldName::NUMERO_PIECE},
            FieldName::CATEGORIE => $this->{FieldName::CATEGORIE},
        ];
    }
}
