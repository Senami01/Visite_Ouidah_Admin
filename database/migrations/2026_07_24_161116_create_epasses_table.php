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
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::REFERENCE)->unique();
            $table->enum(FieldName::TYPE_INITIATEUR, [Constant::GUIDE, Constant::AGENCE, Constant::VISITEUR]);
            $table->foreignUuid(FieldName::ACTEUR_MOBILE_ID)->references(FieldName::ID)->on(TableName::USERS)->cascadeOnDelete();
            $table->foreignUuid(FieldName::VISITEUR_ID)->references(FieldName::ID)->on(TableName::VISITEURS)->cascadeOnDelete();
            $table->enum(FieldName::STATUT, [Constant::EN_ATTENTE, Constant::CONSOMME, Constant::EXPIRE]);
            $table->decimal(FieldName::MONTANT_HT, 10, 2);
            $table->decimal(FieldName::MONTANT_TAXES, 10, 2);
            $table->decimal(FieldName::MONTANT_TOTAL, 10, 2);
            $table->timestamp(FieldName::DATE_CREATION);
            $table->date(FieldName::DATE_REALISATION);
            $table->timestamps();
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
