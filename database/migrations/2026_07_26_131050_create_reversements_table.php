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
            $table->id();
            $table->unsignedBigInteger(FieldName::ACTEUR_REVERSEMENT_ID);
            $table->date(FieldName::DATE_DEBUT);
            $table->date(FieldName::DATE_FIN);
            $table->decimal(FieldName::MONTANT);
            $table->enum(FieldName::MODE, [Constant::MOBILE_MONEY, Constant::VIREMENT, Constant::CHEQUE, Constant::ESPECES]);
            $table->unsignedBigInteger(FieldName::MOYEN_PAIEMENT_ID);
            $table->unsignedBigInteger(FieldName::COMPTE_EXPEDITEUR_ID);
            $table->text(FieldName::OBSERVATION);
            $table->enum(FieldName::STATUT, [Constant::EN_ATTENTE_VALIDATION, Constant::REVERSE]);
            $table->string(FieldName::TRANSACTION_ID);
            $table->string(FieldName::ORDER_ID);
            $table->string(FieldName::DEVISE);
            $table->timestamp(FieldName::DATE_TRANSACTION);
            $table->date(FieldName::DATE_VIREMENT_REEL);
            $table->string(FieldName::NUMERO_CHEQUE);
            $table->date(FieldName::DATE_RECEPTION_CHEQUE);
            $table->unsignedBigInteger(FieldName::VALIDE_PAR);
            $table->unsignedBigInteger(FieldName::CREATED_BY);
            $table->foreign(FieldName::ACTEUR_REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEURS_REVERSEMENT)->onDelete('cascade');
            $table->foreign(FieldName::MOYEN_PAIEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEUR_MOYENS_PAIEMENT)->onDelete('cascade');
            $table->foreign(FieldName::COMPTE_EXPEDITEUR_ID)->references(FieldName::ID)->on(TableName::COMPTES_EXPEDITEUR)->onDelete('cascade');
            $table->foreign(FieldName::VALIDE_PAR)->references(FieldName::ID)->on(TableName::ADMINISTRATEURS)->onDelete('cascade');
            $table->foreign(FieldName::CREATED_BY)->references(FieldName::ID)->on(TableName::ADMINISTRATEURS)->onDelete('cascade');
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
