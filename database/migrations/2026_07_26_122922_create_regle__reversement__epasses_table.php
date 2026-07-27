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
        Schema::create(TableName::REGLE_REVERSEMENT_EPASS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->boolean(FieldName::EPASS_ATTENTE_REVERSES);
            $table->boolean(FieldName::AUTORISER_REVERSEMENT_ATTENTE);
            $table->decimal(FieldName::PART_GERANT_SITE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::REGLE_REVERSEMENT_EPASS);
    }
};
