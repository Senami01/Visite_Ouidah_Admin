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
        Schema::create(TableName::AVIS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::ACTEUR_MOBILE_ID);
            $table->unsignedBigInteger(FieldName::VISITEUR_ID);
            $table->integer(FieldName::NOTE);
            $table->text(FieldName::CONTENU);
            $table->enum(FieldName::STATUT, [Constant::PUBLIE, Constant::CONTESTE]);
            $table->foreign(FieldName::ACTEUR_MOBILE_ID)->references(FieldName::ID)->on(TableName::ACTEURS_MOBILE)->onDelete('cascade');
            $table->foreign(FieldName::VISITEUR_ID)->references(FieldName::ID)->on(TableName::VISITEURS)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::AVIS);
    }
};
