<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Epass_Taxes extends Model
{
    protected $table = TableName::EPASS_TAXES;

    protected $fillable = [
        FieldName::EPASS_ID,
        FieldName::TAXE_ID,
        FieldName::LIBELLE,
        FieldName::MONTANT
    ];
}
