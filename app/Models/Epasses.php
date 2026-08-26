<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Epasses extends Model
{
    use HasUuids;
    protected $table = TableName::EPASSES;
    protected $fillable = [
        FieldName::REFERENCE,
        FieldName::TYPE_INITIATEUR,
        FieldName::ACTEUR_MOBILE_ID,
        FieldName::VISITEUR_ID,
        FieldName::STATUT,
        FieldName::MONTANT_HT,
        FieldName::MONTANT_TAXES,
        FieldName::MONTANT_TOTAL,
        FieldName::DATE_CREATION,
        FieldName::DATE_REALISATION
    ];

    protected function casts() : array
    {
        return [
            FieldName::DATE_REALISATION => 'date',
        ];
    }

    public function acteurmobile(): belongsTo
    {
        return $this->belongsTo(User::class, FieldName::ACTEUR_MOBILE_ID);
    }

    public function visiteur(): belongsTo
    {
        return $this->belongsTo(Visiteurs::class, FieldName::VISITEUR_ID);
    }
}
