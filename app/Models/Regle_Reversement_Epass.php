<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Regle_Reversement_Epass extends Model
{
    protected $table = TableName::REGLE_REVERSEMENT_EPASS;
    protected $fillable = [
        FieldName::EPASS_ATTENTE_REVERSES,
        FieldName::AUTORISER_REVERSEMENT_ATTENTE,
        FieldName::PART_GERANT_SITE
    ];
}
