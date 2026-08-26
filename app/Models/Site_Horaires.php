<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Site_Horaires extends Model
{
    protected $table = TableName::SITE_HORAIRES;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::JOUR,
        FieldName::OUVERTURE,
        FieldName::FERMETURE
    ];

    public function site(): belongsTo
    {
        return $this->belongsTo(Sites_Touristiques::class, FieldName::SITE_ID);
    }
}
