<?php

namespace App\Models;
use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Site_Medias extends Model
{
    protected $table = TableName::SITE_MEDIAS;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::TYPE,
        FieldName::URL,
        FieldName::EST_COUVERTURE,
        FieldName::ORDRE
    ];
}
