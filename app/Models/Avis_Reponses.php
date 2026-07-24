<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Avis_Reponses extends Model
{
    protected $table = TableName::AVIS_REPONSES;
    protected $fillable = [
        FieldName::AVIS_ID,
        FieldName::AUTEUR_USER_MOBILE_ID,
        FieldName::CONTENU
    ];
}
