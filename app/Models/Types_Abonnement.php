<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Types_Abonnement extends Model
{
    protected $table = TableName::TYPES_ABONNEMENT;

    protected $fillable = [
        FieldName::LIBELLE,
        FieldName::MONTANT,
        FieldName::DUREE_JOURS,
        FieldName::COULEUR
    ];
}
