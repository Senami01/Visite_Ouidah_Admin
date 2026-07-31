<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = TableName::ROLE;

    protected $fillable = [
        FieldName::NOM,
        FieldName::DESCRIPTION,
    ];
}
