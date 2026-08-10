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
        Schema::create(TableName::JOURNAL_ACTIVITE, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::ENTITE);
            $table->uuid(FieldName::ENTITE_ID);
            $table->string(FieldName::ACTION);
            $table->text(FieldName::DETAILS);
            $table->foreignUuid(FieldName::AUTEUR_ADMIN_ID)->references(FieldName::ID)->on(TableName::USERS)->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::JOURNAL_ACTIVITE);
    }
};
