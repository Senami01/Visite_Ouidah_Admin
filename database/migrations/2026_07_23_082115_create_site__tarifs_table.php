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
        Schema::create(TableName::SITE_TARIFS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::SITE_ID)->references(FieldName::ID)->on(TableName::SITES_TOURISTIQUES)->cascadeOnDelete();
            $table->string(FieldName::LIBELLE)->nullable();
            $table->string(FieldName::CODE)->nullable();
            $table->decimal(FieldName::MONTANT);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::SITE_TARIFS);
    }
};
