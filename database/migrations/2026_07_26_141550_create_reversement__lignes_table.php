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
            $table->id();
            $table->unsignedBigInteger(FieldName::REVERSEMENT_ID);
            $table->unsignedBigInteger(FieldName::EPASS_ID);
            $table->unsignedBigInteger(FieldName::ABONNEMENT_ID);
            $table->string(FieldName::LIBELLE);
            $table->decimal(FieldName::MONTANT);
            $table->decimal(FieldName::A_REVERSER);
            $table->foreign(FieldName::REVERSEMENT_ID)->references(FieldName::ID)->on(TableName::REVERSEMENTS)->onDelete('cascade');
            $table->foreign(FieldName::EPASS_ID)->references(FieldName::ID)->on(TableName::EPASSES)->onDelete('cascade');
            $table->foreign(FieldName::ABONNEMENT_ID)->references(FieldName::ID)->on(TableName::ABONNEMENTS)->onDelete('cascade');
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
