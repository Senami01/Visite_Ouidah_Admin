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
        Schema::create(TableName::ACTEUR_MOYENS_PAIEMENT, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::ACTEUR_REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEURS_REVERSEMENT)->cascadeOnDelete();
            $table->enum(FieldName::MODE, [Constant::MOBILE_MONEY, Constant::VIREMENT,Constant::CHEQUE,Constant::ESPECES]);
            $table->enum(FieldName::CONFIG_MODE, [Constant::AUTOMATIQUE, Constant::MANUEL]);
            $table->boolean(FieldName::ACTIF);
            $table->enum(FieldName::RESEAU, [Constant::MTN, Constant::MOOV, Constant::CELTIIS]);
            $table->string(FieldName::NUMERO_MOBILE);
            $table->string(FieldName::INTITULE_COMPTE);
            $table->string(FieldName::BANQUE);
            $table->string(FieldName::NUMERO_COMPTE);
            $table->string(FieldName::IBAN);
            $table->string(FieldName::CODE_PAYS);
            $table->string(FieldName::CODE_BANQUE);
            $table->string(FieldName::CODE_GUICHET);
            $table->string(FieldName::CLE_RIB);
            $table->string(FieldName::CODE_SWIFT);
            $table->string(FieldName::DEVISE);
            $table->string(FieldName::A_L_ORDRE_DE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::ACTEUR_MOYENS_PAIEMENT);
    }
};
