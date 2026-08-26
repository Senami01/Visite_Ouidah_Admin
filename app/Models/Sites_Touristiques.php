<?php

namespace App\Models;

use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Sites_Touristiques extends Model
{
     use HasUuids; 

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
        FieldName::ACTEUR_MOBILE_ID
    ];

    public function administrateur(): belongsTo
    {
        return $this->belongsTo(User::class, FieldName::CREATED_BY);
    }

    public function acteurMobile(): belongsTo
    {
        return $this->belongsTo(User::class, FieldName::ACTEUR_MOBILE_ID);
    }

    public function visite(): HasMany
    {
        return $this->hasMany(Visites::class, FieldName::SITE_ID);
    }
    public function horaires(): HasMany
    {
        return $this->hasMany(Site_Horaires::class, 'site_id');
    }

    public function medias(): HasMany
    {
        return $this->hasMany(Site_Medias::class, 'site_id');
    }

    public function tarifs(): HasMany
    {
        return $this->hasMany(Site_Tarifs::class, 'site_id');
    }

    public function fraisSupplementaires(): HasMany
    {
        return $this->hasMany(Site_Frais_Supplementaires::class, 'site_id');
    }

}
