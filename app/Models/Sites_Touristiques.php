<?php

namespace App\Models;

use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sites_Touristiques extends Model
{
     use HasUuids; // 💡 Activation de la génération automatique de l'id UUID

    protected $keyType = 'string';
    public $incrementing = false;
    
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
        FieldName::CREATED_BY,
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::INDICATIONS
    ];

    public function administrateur(): belongsTo
    {
        return $this->belongsTo(User::class, FieldName::CREATED_BY);
    }

    public function acteurMobile(): belongsTo
    {
        return $this->belongsTo(Utilisateurs_Mobile::class, FieldName::ACTEUR_MOBILE_ID);
    }
}
