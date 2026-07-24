<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Epass_Personnes extends Model
{
    protected $table = TableName::EPASS_PERSONNES;
    protected $fillable = [
        FieldName::EPASS_ID,
        FieldName::NOM,
        FieldName::PAYS,
        FieldName::TYPE_PIECE,
        FieldName::NUMERO_PIECE,
        FieldName::CATEGORIE
    ];
}
