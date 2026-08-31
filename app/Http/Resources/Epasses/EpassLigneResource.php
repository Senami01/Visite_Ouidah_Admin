<?php

namespace App\Http\Resources\Epasses;

use App\Lib\FieldName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpassLigneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            FieldName::EPASS_ID => $this->{FieldName::EPASS_ID},
            FieldName::SITE_ID => $this->{FieldName::SITE_ID},
            FieldName::LIBELLE => $this->{FieldName::LIBELLE},
            FieldName::TARIF_UNITAIRE => (float) $this->{FieldName::TARIF_UNITAIRE},
            FieldName::QUANTITE => $this->{FieldName::QUANTITE},
            FieldName::MONTANT => (float) $this->{FieldName::MONTANT},
            FieldName::DATE_REALISATION => $this->{FieldName::DATE_REALISATION}?->format('Y-m-d'),
            FieldName::STATUT => $this->{FieldName::STATUT},
        ];
    }
}
