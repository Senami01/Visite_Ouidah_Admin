<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Epass_Lignes extends Model
{
    protected $table = TableName::EPASS_LIGNES;
    protected $fillable = [
        FieldName::EPASS_ID,
        FieldName::SITE_ID,
        FieldName::LIBELLE,
        FieldName::TARIF_UNITAIRE,
        FieldName::QUANTITE,
        FieldName::MONTANT,
        FieldName::DATE_REALISATION,
        FieldName::STATUT
    ];

    protected function casts() : array
    {
        return [
            FieldName::DATE_REALISATION => 'date',
        ];
    }
}
