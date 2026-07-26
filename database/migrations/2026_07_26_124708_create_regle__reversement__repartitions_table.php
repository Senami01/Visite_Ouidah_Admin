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
        Schema::create(TableName::REGLE_REVERSEMENT_REPARTITIONS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::REGLE_ID);
            $table->unsignedBigInteger(FieldName::ACTEUR_REVERSEMENT_ID);
            $table->decimal(FieldName::POURCENTAGE);
            $table->foreign(FieldName::REGLE_ID)->references(FieldName::ID)->on(TableName::REGLE_REVERSEMENT_EPASS)->onDelete('cascade');
            $table->foreign(FieldName::ACTEUR_REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEURS_REVERSEMENT)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::REGLE_REVERSEMENT_REPARTITIONS);
    }
};
