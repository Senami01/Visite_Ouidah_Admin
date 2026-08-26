<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Site_Frais_Supplementaires extends Model
{
    protected $table = TableName::SITE_FRAIS_SUPPLEMENTAIRES;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::LIBELLE,
        FieldName::MONTANT
    ];

    public function site(): belongsTo
    {
        return $this->belongsTo(Sites_Touristiques::class, FieldName::SITE_ID);
    }
    
}
