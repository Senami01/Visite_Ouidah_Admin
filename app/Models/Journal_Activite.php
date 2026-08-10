<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Journal_Activite extends Model
{
    protected $table = TableName::JOURNAL_ACTIVITE;

    protected $fillable = [
        FieldName::ENTITE,
        FieldName::ENTITE_ID,
        FieldName::ACTION,
        FieldName::DETAILS,
        FieldName::AUTEUR_ADMIN_ID
    ];

    public function administrateur(): belongsTo
    {
        return $this->belongsTo(User::class, FieldName::AUTEUR_ADMIN_ID);
    }
}
