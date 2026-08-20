<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Utilisateurs_Mobile extends Model
{
    protected $table = TableName::UTILISATEURS_MOBILE;
    protected $primaryKey = FieldName::ID;
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

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, FieldName::ACTEUR_MOBILE_ID);
    }
}
