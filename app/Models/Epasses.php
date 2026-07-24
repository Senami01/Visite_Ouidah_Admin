<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Epasses extends Model
{
    protected $table = TableName::EPASSES;
    protected $fillable = [
        FieldName::REFERENCE,
        FieldName::TYPE_INIATEUR,
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::STATUT,
        FieldName::MONTANT_HT,
        FieldName::MONTANT_TAXES,
        FieldName::MONTANT_TOTAL,
        FieldName::DATE_CREATION,
        FieldName::DATE_REALISATION
    ];

    protected function casts() : array
    {
        return [
            FieldName::DATE_REALISATION => 'date',
        ];
    }
}
