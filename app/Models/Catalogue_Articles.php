<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Catalogue_Articles extends Model
{
    protected $table = TableName::CATALOGUE_ARTICLES;

    protected $fillable = [
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::LIBELLE,
        FieldName::COUT,
        FieldName::DESCRIPTION,
        FieldName::LIEN
    ];
}
