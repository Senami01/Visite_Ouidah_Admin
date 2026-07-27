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
        Schema::create(TableName::TYPES_ABONNEMENT, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::LIBELLE);
            $table->decimal(FieldName::MONTANT);
            $table->integer(FieldName::DUREE_JOURS);
            $table->string(FieldName::COULEUR);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::TYPES_ABONNEMENT);
    }
};
