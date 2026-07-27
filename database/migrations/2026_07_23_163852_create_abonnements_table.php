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
        Schema::create(TableName::ABONNEMENTS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::TYPE_ABONNEMENT_ID)->references(FieldName::ID)->on(TableName::TYPES_ABONNEMENT)->cascadeonDelete();
            $table->foreignUuid(FieldName::ACTEUR_MOBILE_ID)->references(FieldName::ID)->on(TableName::ACTEURS_MOBILE)->cascadeOnDelete();
            $table->date(FieldName::DATE_DEBUT);
            $table->date(FieldName::DATE_FIN);
            $table->decimal(FieldName::MONTANT);
            $table->enum(FieldName::STATUT, [Constant::ACTIF, Constant::EXPIRE]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::ABONNEMENTS);
    }
};
