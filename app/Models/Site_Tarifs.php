<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Site_Tarifs extends Model
{
    protected $table = TableName::SITE_TARIFS;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::LIBELLE,
        FieldName::CODE,
        FieldName::MONTANT
    ];
}
