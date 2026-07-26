<?php

namespace App\Models;

use App\Lib\TableName;
use App\Lib\FieldName;
use Illuminate\Database\Eloquent\Model;
use Override;

class Reversements extends Model
{
    protected $table = TableName::REVERSEMENTS;
    protected $fillable = [
        FieldName::ACTEUR_REVERSEMENT_ID,
        FieldName::PERIODE_DEBUT,
        FieldName::PERIODE_FIN,
        FieldName::MONTANT,
        FieldName::MODE,
        FieldName::MOYEN_PAIEMENT_ID,
        FieldName::COMPTE_EXPEDITEUR_ID,
        FieldName::OBSERVATION,
        FieldName::STATUT,
        FieldName::TRANSACTION_ID,
        FieldName::ORDER_ID,
        FieldName::DEVISE,
        FieldName::DATE_TRANSACTION,
        FieldName::DATE_VIREMENT_REEL,
        FieldName::NUMERO_CHEQUE,
        FieldName::DATE_RECEPTION_CHEQUE,
        FieldName::VALIDE_PAR,
        FieldName::CREATED_BY
    ]; 

    #[Override]
    protected function casts(): array
    {
        return [
            FieldName::DATE_DEBUT => 'date',
            FieldName::DATE_FIN => 'date',
            FieldName::DATE_VIREMENT_REEL => 'date',
            FieldName::DATE_RECEPTION_CHEQUE => 'date',
        ];
    }
}
