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
        Schema::create(TableName::EPASS_TAXES, function (Blueprint $table) {
            $table->uuid(FieldName::ID);
            $table->foreignUuid(FieldName::EPASS_ID)->references(FieldName::ID)->on(TableName::EPASSES)->cascadeOnDelete();
            $table->foreignUuid(FieldName::TAXE_ID)->references(FieldName::ID)->on(TableName::TAXES)->cascadeOnDelete();
            $table->string(FieldName::LIBELLE);
            $table->decimal(FieldName::MONTANT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::EPASS_TAXES);
    }
};
