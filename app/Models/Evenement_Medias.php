<?php

namespace App\Models;
use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Evenement_Medias extends Model
{
    protected $table = TableName::EVENEMENT_MEDIAS;
    protected $fillable = [
        FieldName::EVENEMENT_ID,
        FieldName::TYPE,
        FieldName::URL,
        FieldName::ORDRE
    ];
}
