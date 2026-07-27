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
        Schema::create(TableName::AVIS_REPONSES, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::AVIS_ID)->references(FieldName::ID)->on(TableName::AVIS)->cascadeOnDelete();
            $table->foreignUuid(FieldName::AUTEUR_USER_MOBILE_ID)->references(FieldName::ID)->on(TableName::UTILISATEURS_MOBILE)->cascadeOnDelete();
            $table->text(FieldName::CONTENU);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::AVIS_REPONSES);
    }
};
