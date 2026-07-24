<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Site_Horaires extends Model
{
    protected $table = TableName::SITE_HORAIRES;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::JOUR,
        FieldName::OUVERTURE,
        FieldName::FERMETURE
    ];
}
