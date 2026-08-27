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
        Schema::create(TableName::VISITES, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::EPASS_ID)->references(FieldName::ID)->on(TableName::EPASSES)->cascadeOnDelete();
            $table->foreignUuid(FieldName::SITE_ID)->references(FieldName::ID)->on(TableName::SITES_TOURISTIQUES)->cascadeOnDelete();
            $table->foreignUuid(FieldName::VISITEUR_ID)->references(FieldName::ID)->on(TableName::VISITEURS)->cascadeOnDelete();
            $table->date(FieldName::DATE_VISITE);
            $table->enum(FieldName::STATUT, [Constant::PROGAMMEE, Constant::EN_COURS, Constant::EFFECTUEE, Constant::EN_RETARD, Constant::ANNULEE, Constant::ABSENTE]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::VISITES);
    }
};
