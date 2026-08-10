<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUuids;
    
    protected $table = TableName::ROLE;

    protected $primaryKey = FieldName::ID;
    protected $fillable = [
        FieldName::NOM,
        FieldName::DESCRIPTION,
    ];

    public function Administrateurs(): HasMany
    {
        return $this->hasMany(User::class, FieldName::ROLE_ID);
    }
}
