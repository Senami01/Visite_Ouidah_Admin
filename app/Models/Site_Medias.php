<?php

namespace App\Models;
use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Site_Medias extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $table = TableName::SITE_MEDIAS;

    protected $fillable = [
        FieldName::SITE_ID,
        FieldName::TYPE,
        FieldName::URL,
        FieldName::EST_COUVERTURE,
        FieldName::ORDRE
    ];

    public function site(): belongsTo
    {
        return $this->belongsTo(Sites_Touristiques::class, FieldName::SITE_ID);
    }

}
