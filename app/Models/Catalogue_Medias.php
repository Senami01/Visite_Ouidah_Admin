<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Catalogue_Medias extends Model
{
    protected $table = TableName::CATALOGUE_MEDIAS;

    protected $fillable = [
        FieldName::ARTICLE_ID,
        FieldName::TYPE,
        FieldName::URL,
        FieldName::ORDRE
    ];
}
