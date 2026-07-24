<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Abonnements extends Model
{
    protected $table = TableName::ABONNEMENTS;
    protected $fillable = [
        FieldName::TYPE_ABONNEMENT_ID,
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::DATE_DEBUT,
        FieldName::DATE_FIN,
        FieldName::MONTANT,
        FieldName::STATUT
    ];

    protected function casts(): array
    {
        return [
            FieldName::DATE_DEBUT => 'date',
            FieldName::DATE_FIN => 'date',
        ];
    }
}

