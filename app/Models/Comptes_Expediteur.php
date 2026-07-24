<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Comptes_Expediteur extends Model
{
    protected $table = TableName::COMPTES_EXPEDITEUR;
    protected $fillable = [
        FieldName::MODE,
        FieldName::CONFIG_MODE,
        FieldName::ACTIF,
        FieldName::BANQUE,
        FieldName::RESEAU,
        FieldName::INTITULE,
        FieldName::NUMERO_COMPTE,
        FieldName::NUMERO_MOBILE
    ];
}
