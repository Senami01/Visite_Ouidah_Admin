<?php

use App\Lib\TableName;
use App\Lib\FieldName;
use App\Lib\Constant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(TableName::REVERSEMENTS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::ACTEUR_REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEURS_REVERSEMENT)->cascadeOnDelete();
            $table->date(FieldName::DATE_DEBUT);
            $table->date(FieldName::DATE_FIN);
            $table->decimal(FieldName::MONTANT);
            $table->enum(FieldName::MODE, [Constant::MOBILE_MONEY, Constant::VIREMENT, Constant::CHEQUE, Constant::ESPECES]);
            $table->foreignUuid(FieldName::MOYEN_PAIEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEUR_MOYENS_PAIEMENT)->cascadeOnDelete();
            $table->foreignUuid(FieldName::COMPTE_EXPEDITEUR_ID)->references(FieldName::ID)->on(TableName::COMPTES_EXPEDITEUR)->cascadeOnDelete();
            $table->text(FieldName::OBSERVATION);
            $table->enum(FieldName::STATUT, [Constant::EN_ATTENTE_VALIDATION, Constant::REVERSE]);
            $table->string(FieldName::TRANSACTION_ID);
            $table->string(FieldName::ORDER_ID);
            $table->string(FieldName::DEVISE);
            $table->timestamp(FieldName::DATE_TRANSACTION);
            $table->date(FieldName::DATE_VIREMENT_REEL);
            $table->string(FieldName::NUMERO_CHEQUE);
            $table->date(FieldName::DATE_RECEPTION_CHEQUE);
            $table->foreignUuid(FieldName::VALIDE_PAR)->references(FieldName::ID)->on(TableName::USERS)->cascadeOnDelete();
            $table->foreignUuid(FieldName::CREATED_BY)->references(FieldName::ID)->on(TableName::USERS)->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::REVERSEMENTS);
    }
};
