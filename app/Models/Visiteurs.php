<?php

namespace App\Models;

use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Database\Eloquent\Model;

class Visiteurs extends Model
{
    protected $table = TableName::VISITEURS;

    protected $fillable = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::PAYS
    ];
}