<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Reversement_Lignes extends Model
{
    protected $table = TableName::REVERSEMENT_LIGNES;
    protected $fillable = [
        FieldName::REVERSEMENT_ID,
        FieldName::EPASS_ID,
        FieldName::ABONNEMENT_ID,
        FieldName::LIBELLE,
        FieldName::MONTANT,
        FieldName::A_REVERSER
    ];
}
