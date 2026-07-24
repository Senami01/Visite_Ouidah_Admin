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
        Schema::create(TableName::EPASS_LIGNES, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::EPASS_ID);
            $table->unsignedBigInteger(FieldName::SITE_ID);
            $table->string(FieldName::LIBELLE);
            $table->decimal(FieldName::TARIF_UNITAIRE, 10, 2);
            $table->integer(FieldName::QUANTITE);
            $table->decimal(FieldName::MONTANT, 10, 2);
            $table->date(FieldName::DATE_REALISATION);
            $table->enum(FieldName::STATUT, [Constant::PROGAMMEE, Constant::EN_COURS, Constant::EFFECTUEE, Constant::EN_RETARD, Constant::ANNULEE, Constant::ABSENTE]);
            $table->foreign(FieldName::EPASS_ID)->references(FieldName::ID)->on(TableName::EPASSES)->onDelete('cascade');
            $table->foreign(FieldName::SITE_ID)->references(FieldName::ID)->on(TableName::SITES_TOURISTIQUES)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::EPASS_LIGNES);
    }
};
