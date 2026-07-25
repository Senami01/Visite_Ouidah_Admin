<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    protected $table = TableName::TAXES;

    protected $fillable = [
        FieldName::LIBELLE,
        FieldName::MONTANT,
        FieldName::ACTIF
    ];
}
