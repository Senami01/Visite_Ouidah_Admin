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
        Schema::create(TableName::EPASSES, function (Blueprint $table) {
            $table->id();
            $table->string(FieldName::REFERENCE)->unique();
            $table->enum(FieldName::TYPE_INIATEUR, [Constant::GUIDE, Constant::AGENCE, Constant::VISITEUR]);
            $table->unsignedBigInteger(FieldName::ACTEUR_MOBILE_ID);
            $table->enum(FieldName::STATUT, [Constant::EN_ATTENTE, Constant::CONSOMME, Constant::EXPIRE]);
            $table->decimal(FieldName::MONTANT_HT, 10, 2);
            $table->decimal(FieldName::MONTANT_TAXES, 10, 2);
            $table->decimal(FieldName::MONTANT_TOTAL, 10, 2);
            $table->timestamp(FieldName::DATE_CREATION);
            $table->dateTime(FieldName::DATE_REALISATION);
            $table->foreign(FieldName::ACTEUR_MOBILE_ID)->references(FieldName::ID)->on(TableName::ACTEURS_MOBILE)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::EPASSES);
    }
};
