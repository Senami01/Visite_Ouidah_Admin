<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Acteurs_Reversement extends Model
{
    protected $table = TableName::ACTEURS_REVERSEMENT;

    protected $fillable = [
        FieldName::NOM,
        FieldName::PEUT_GERER_SITE,
        FieldName::ELIGIBLE_ABONNEMENT
    ];
}
