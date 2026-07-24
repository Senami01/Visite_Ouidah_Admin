<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Site_Frais_Supplementaires extends Model
{
    protected $table = TableName::SITE_FRAIS_SUPPLEMENTAIRES;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::LIBELLE,
        FieldName::MONTANT
    ];
}
