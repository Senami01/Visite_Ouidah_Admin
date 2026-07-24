<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = TableName::AVIS;
    protected $fillable = [
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::VISITEUR_ID,
        FieldName::NOTE,
        FieldName::CONTENU,
        FieldName::STATUT
    ];
}
