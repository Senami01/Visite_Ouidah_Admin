<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Visites extends Model
{
    protected $table = TableName::VISITES;

    protected $fillable = [
        FieldName::EPASS_ID,
        FieldName::SITE_ID,
        FieldName::VISITEUR_ID,
        FieldName::DATE_VISITE,
        FieldName::STATUT
    ];
}
