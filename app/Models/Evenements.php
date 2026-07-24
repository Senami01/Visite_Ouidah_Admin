<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Evenements extends Model
{
    protected $table = TableName::EVENEMENTS;
    protected $fillable = [
        FieldName::TITRE,
        FieldName::DESCRIPTION,
        FieldName::LIEU,
        FieldName::DATE_DEBUT,
        FieldName::DATE_FIN,
        FieldName::PAGE_WEB,
        FieldName::STATUT,
        FieldName::CREATED_BY
    ];
}
