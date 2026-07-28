<?php

namespace App\Models;

use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteurs extends Model
{
    use HasFactory;

    protected $table = TableName::VISITEURS;
    protected $primaryKey = FieldName::ID;
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::PAYS
    ];
}