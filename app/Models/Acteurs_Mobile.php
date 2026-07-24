<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Acteurs_Mobile extends Model
{
    protected $table = TableName::ACTEURS_MOBILE;

    protected $fillable = [
        FieldName::TYPE,
        FieldName::DENOMINATION,
        FieldName::NUMERO,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::SITE_WEB,
        FieldName::ADRESSE,
        FieldName::LATITUDE,
        FieldName::LONGITUDE,
        FieldName::A_PROPOS,
        FieldName::LANGUES_PARLEES,
        FieldName::SPECIALITES,
        FieldName::DATE_AGREMENT,
        FieldName::STATUT
    ];

    protected function casts(): array
    {
        return [
            FieldName::DATE_AGREMENT => 'date',
        ];
    }
}
