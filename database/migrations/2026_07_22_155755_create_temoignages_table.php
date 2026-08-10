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
        Schema::create(TableName::TEMOIGNAGES, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::AUTEUR);
            $table->foreignUuid(FieldName::VISITEUR_ID)->references(FieldName::ID)->on(TableName::VISITEURS)->cascadeOnDelete();
            $table->text(FieldName::CONTENU);
            $table->integer(FieldName::NOTE);
            $table->boolean(FieldName::PUBLIE)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::TEMOIGNAGES);
    }
};
