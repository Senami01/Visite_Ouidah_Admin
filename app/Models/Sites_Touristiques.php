<?php

namespace App\Models;

use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Sites_Touristiques extends Model
{
    protected $table = TableName::SITES_TOURISTIQUES;

    protected $fillable = [
        FieldName::NOM,
        FieldName::CATEGORIE,
        FieldName::LATITUDE,
        FieldName::LONGITUDE,
        FieldName::ACCES,
        FieldName::COURTE_DESCRIPTION,
        FieldName::A_PROPOS_TITRE,
        FieldName::A_PROPOS_DESCRIPTION,
        FieldName::CONSEILS_PRATIQUES,
        FieldName::TYPE_TARIFICATION,
        FieldName::OUVERT_24_7,
        FieldName::STATUT,
        FieldName::DATE_BROUILLON,
        FieldName::DATE_PUBLICATION,
        FieldName::CREATED_BY
    ];

    public function administrateur(): belongsTo
    {
        return $this->belongsTo(Administrateurs::class, FieldName::CREATED_BY);
    }
}
