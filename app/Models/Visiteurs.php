<?php

namespace App\Models;

use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteurs extends Model
{
    use HasFactory, HasUuids;

    protected $table = TableName::VISITEURS;
    protected $primaryKey = FieldName::ID;
    
    protected $fillable = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::PAYS
    ];

    public function epasse(): HasMany
    {
        return $this->hasMany(Epasses::class, FieldName::VISITEUR_ID);
    }
}