<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Carrousel_Medias extends Model
{
    protected $table = TableName::CARROUSEL_MEDIAS;

    protected $fillable = [
        FieldName::TITRE,
        FieldName::TYPE,
        FieldName::URL,
        FieldName::ORDRE,
        FieldName::STATUT,
        FieldName::CREATED_BY
    ];
}
