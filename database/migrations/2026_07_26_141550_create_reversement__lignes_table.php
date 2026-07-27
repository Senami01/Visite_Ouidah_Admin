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
        Schema::create(TableName::REVERSEMENT_LIGNES, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::REVERSEMENTS)->cascadeOnDelete();
            $table->foreignUuid(FieldName::EPASS_ID)->references(FieldName::ID)->on(TableName::EPASSES)->cascadeOnDelete();
            $table->foreignUuid(FieldName::ABONNEMENT_ID)->references(FieldName::ID)->on(TableName::ABONNEMENTS)->cascadeOnDelete();
            $table->string(FieldName::LIBELLE);
            $table->decimal(FieldName::MONTANT);
            $table->decimal(FieldName::A_REVERSER);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::REVERSEMENT_LIGNES);
    }
};
