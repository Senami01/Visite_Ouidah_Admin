<?php

namespace App\Models;
use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Abonnement_Repartitions extends Model
{
    protected $table = TableName::ABONNEMENT_REPARTITIONS;

    protected $fillable = [
        FieldName::TYPE_ABONNEMENT_ID,
        FieldName::ACTEUR_REVERSEMENT_ID,
        FieldName::POURCENTAGE
    ];
}
