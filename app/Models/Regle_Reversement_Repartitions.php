<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Regle_Reversement_Repartitions extends Model
{
    protected $table = TableName::REGLE_REVERSEMENT_REPARTITIONS;
    protected $fillable = [
        FieldName::REGLE_ID,
        FieldName::ACTEUR_REVERSEMENT_ID,
        FieldName::POURCENTAGE
    ];
}
