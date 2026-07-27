<?php

use App\Lib\TableName;
use App\Lib\FieldName;
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
        Schema::create(TableName::ABONNEMENT_REPARTITIONS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::TYPE_ABONNEMENT_ID)->references(FieldName::ID)->on(TableName::TYPES_ABONNEMENT)->cascadeOnDelete();
            $table->foreignUuid(FieldName::ACTEUR_REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEURS_REVERSEMENT)->cascadeOnDelete();
            $table->decimal(FieldName::POURCENTAGE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::ABONNEMENT_REPARTITIONS);
    }
};
