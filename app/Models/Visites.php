<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Visites extends Model
{
    use HasUuids;

    protected $table = TableName::VISITES;
    protected $primaryKey = FieldName::ID;
    protected $fillable = [
        FieldName::EPASS_ID,
        FieldName::SITE_ID,
        FieldName::VISITEUR_ID,
        FieldName::DATE_VISITE,
        FieldName::STATUT
    ];

    public function visiteur(): belongsTo
    {
        return $this->belongsTo(Visiteurs::class, FieldName::VISITEUR_ID);
    }

    public function siteTouristique(): belongsTo
    {
        return $this->belongsTo(Sites_Touristiques::class, FieldName::SITE_ID);
    }

    public function epasse(): belongsTo
    {
        return $this->belongsTo(Epasses::class, FieldName::EPASS_ID);
    }
}
