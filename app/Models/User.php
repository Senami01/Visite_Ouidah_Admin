<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasUuids, Notifiable;

    protected $table = TableName::USERS;

    protected $primaryKey = FieldName::ID;
    protected $fillable = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::DENOMINATION,
        FieldName::SITE_WEB,
        FieldName::ADRESSE,
        FieldName::LATITUDE,
        FieldName::LONGITUDE,
        FieldName::A_PROPOS,
        FieldName::LANGUES_PARLEES,
        FieldName::SPECIALITES,
        FieldName::DATE_AGREMENT,
        FieldName::TYPE,
        FieldName::PASSWORD,
        FieldName::ROLE,
        FieldName::STATUT,
        FieldName::TYPE_ACTEUR,
        FieldName::DERNIERE_CONNEXION,
        FieldName::EMAIL_VERIFIE_LE,
        FieldName::OTP,
        FieldName::EXPIRE_LE,
    ];


    protected function casts(): array
    {
        return [
            FieldName::DATE_AGREMENT => 'date',
            FieldName::DERNIERE_CONNEXION => 'datetime',
            FieldName::EMAIL_VERIFIE_LE => 'datetime',
            FieldName::PASSWORD => 'hashed',
        ];
    }

    public function sitesTouristiques(): HasMany
    {
        return $this->hasMany(Sites_Touristiques::class, FieldName::CREATED_BY);
    }

    public function role(): belongsTo
    {
        return $this->belongsTo(Role::class, FieldName::ROLE_ID);
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
