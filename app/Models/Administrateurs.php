<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Administrateurs extends Model
{
    use HasFactory;

    protected $table = TableName::ADMINISTRATEURS;

    protected $primaryKey = FieldName::ID;
    protected $keyType = 'string';
    protected $fillable = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::ADRESSE_RESIDENCE,
        FieldName::MOT_DE_PASSE_HASH,
        FieldName::ROLE,
        FieldName::STATUT,
        FieldName::DERNIERE_CONNEXION
    ];

    public function sitesTouristiques(): HasMany
    {
        return $this->hasMany(Sites_Touristiques::class, FieldName::CREATED_BY);
    }

    public function carrouselmedias(): HasMany
    {
        return $this->hasMany(Carrousel_Medias::class, FieldName::CREATED_BY);
    }

    public function contestations(): HasMany
    {
        return $this->hasMany(Contestations::class, FieldName::TRAITE_PAR);
    }

    public function journalactivite(): HasMany
    {
        return $this->hasMany(journal_Activite::class, FieldName::AUTEUR_ADMIN_ID);
    }

    public function evenements(): HasMany
    {
        return $this->hasMany(Evenements::class, FieldName::CREATED_BY);
    }

}
