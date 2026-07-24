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
        Schema::create(TableName::COMPTES_EXPEDITEUR, function (Blueprint $table) {
            $table->id();
            $table->enum(FieldName::MODE, [Constant::MOBILE_MONEY, Constant::VIREMENT,Constant::CHEQUE,Constant::ESPECES]);
            $table->enum(FieldName::CONFIG_MODE, [Constant::AUTOMATIQUE, Constant::MANUEL]);
            $table->boolean(FieldName::ACTIF);
            $table->string(FieldName::BANQUE);
            $table->enum(FieldName::RESEAU, [Constant::MTN, Constant::MOOV, Constant::CELTIIS]);
            $table->string(FieldName::INTITULE);
            $table->string(FieldName::NUMERO_COMPTE);
            $table->string(FieldName::NUMERO_MOBILE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::COMPTES_EXPEDITEUR);
    }
};
