<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Contestations extends Model
{
    protected $table = TableName::CONTESTATIONS;
    protected $fillable = [
        FieldName::AVIS_ID,
        FieldName::MOTIF,
        FieldName::MOTIF_AUTEUR_USER_MOBILE_ID,
        FieldName::STATUT,
        FieldName::OBSERVATION,
        FieldName::FICHER_JOINT,
        FieldName::TRAITE_PAR,
        FieldName::DATE_TRAITEMENT        
    ];
}
