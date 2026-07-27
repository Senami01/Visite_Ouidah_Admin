<?php

use App\Lib\TableName;
use App\Lib\FieldName;
use App\Lib\Constant;
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
        Schema::create(TableName::CONTESTATIONS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::AVIS_ID)->references(FieldName::ID)->on(TableName::AVIS)->cascadeOnDelete();
            $table->text(FieldName::MOTIF);
            $table->foreignUuid(FieldName::MOTIF_AUTEUR_USER_MOBILE_ID)->references(FieldName::ID)->on(TableName::UTILISATEURS_MOBILE)->cascadeOnDelete();
            $table->enum(FieldName::STATUT, [Constant::EN_ATTENTE, Constant::ACCEPTEE, Constant::REJETEE]);
            $table->text(FieldName::OBSERVATION);
            $table->string(FieldName::FICHER_JOINT);
            $table->foreignUuid(FieldName::TRAITE_PAR)->references(FieldName::ID)->on(TableName::ADMINISTRATEURS)->cascadeOnDelete();
            $table->timestamp(FieldName::DATE_TRAITEMENT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::CONTESTATIONS);
    }
};
