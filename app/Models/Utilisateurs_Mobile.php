<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Utilisateurs_Mobile extends Model
{
    protected $table = TableName::UTILISATEURS_MOBILE;

    protected $fillable = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::PAYS,
        FieldName::ROLE,
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::STATUT,
        FieldName::DERNIERE_CONNEXION
    ];

     public function Sites_Touristiques(): HasMany
    {
        return $this->hasMany(Sites_Touristiques::class, FieldName::ACTEUR_MOBILE_ID);
    }
}
