<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Acteur_Moyens_Paiement extends Model
{
    protected $table = TableName::ACTEUR_MOYENS_PAIEMENT;
    protected $fillable = [
        FieldName::ACTEUR_REVERSEMENT_ID,
        FieldName::MODE,
        FieldName::CONFIG_MODE,
        FieldName::ACTIF,
        FieldName::RESEAU,
        FieldName::NUMERO_MOBILE,
        FieldName::INTITULE_COMPTE,
        FieldName::BANQUE,
        FieldName::NUMERO_COMPTE,
        FieldName::IBAN,
        FieldName::CODE_PAYS,
        FieldName::CODE_BANQUE,
        FieldName::CODE_GUICHET,
        FieldName::CLE_RIB,
        FieldName::CODE_SWIFT,
        FieldName::DEVISE,
        FieldName::A_L_ORDRE_DE
    ];
}
