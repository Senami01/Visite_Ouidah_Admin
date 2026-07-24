<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Temoignages extends Model
{
    protected $table = TableName::TEMOIGNAGES;
    protected $fillable = [
        FieldName::AUTEUR,
        FieldName::VISITEUR_ID,
        FieldName::CONTENU,
        FieldName::NOTE,
        FieldName::PUBLIE
    ];
}
