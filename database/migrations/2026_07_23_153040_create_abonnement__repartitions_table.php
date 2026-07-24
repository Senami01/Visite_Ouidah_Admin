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
            $table->id();
            $table->unsignedBigInteger(FieldName::TYPE_ABONNEMENT_ID);
            $table->unsignedBigInteger(FieldName::ACTEUR_REVERSEMENT_ID);
            $table->decimal(FieldName::POURCENTAGE);
            $table->foreign(FieldName::TYPE_ABONNEMENT_ID)->references(FieldName::ID)->on(TableName::TYPES_ABONNEMENT)->onDelete('cascade');
            $table->foreign(FieldName::ACTEUR_REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::ACTEURS_REVERSEMENT)->onDelete('cascade');
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
