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
            $table->id();
            $table->unsignedBigInteger(FieldName::AVIS_ID);
            $table->text(FieldName::MOTIF);
            $table->unsignedBigInteger(FieldName::MOTIF_AUTEUR_USER_MOBILE_ID);
            $table->enum(FieldName::STATUT, [Constant::EN_ATTENTE, Constant::ACCEPTEE, Constant::REJETEE]);
            $table->text(FieldName::OBSERVATION);
            $table->string(FieldName::FICHER_JOINT);
            $table->unsignedBigInteger(FieldName::TRAITE_PAR);
            $table->timestamp(FieldName::DATE_TRAITEMENT);
            $table->foreign(FieldName::AVIS_ID)->references(FieldName::ID)->on(TableName::AVIS)->onDelete('cascade');
            $table->foreign(FieldName::MOTIF_AUTEUR_USER_MOBILE_ID)->references(FieldName::ID)->on(TableName::UTILISATEURS_MOBILE)->onDelete('cascade');
            $table->foreign(FieldName::TRAITE_PAR)->references(FieldName::ID)->on(TableName::ADMINISTRATEURS)->onDelete('cascade');
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
