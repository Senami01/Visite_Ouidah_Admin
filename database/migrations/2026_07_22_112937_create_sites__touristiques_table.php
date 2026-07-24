<?php

use App\Lib\TableName;
use App\Lib\FieldName;
use App\Lib\Constant;
use App\Lib\StatutSite;
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
        Schema::create(TableName::SITES_TOURISTIQUES, function (Blueprint $table) {
            $table->id();
            $table->string(FieldName::NOM)->nullable(false);
            $table->string(FieldName::CATEGORIE);
            $table->decimal(FieldName::LATITUDE, 10, 8);
            $table->decimal(FieldName::LONGITUDE, 11, 8);
            $table->text(FieldName::ACCES);
            $table->text(FieldName::COURTE_DESCRIPTION);
            $table->string(FieldName::A_PROPOS_TITRE);
            $table->text(FieldName::A_PROPOS_DESCRIPTION);
            $table->text(FieldName::CONSEILS_PRATIQUES);
            $table->enum(FieldName::TYPE_TARIFICATION, [Constant::UNIQUE, Constant::DOUBLE]);
            $table->boolean(FieldName::OUVERT_24_7)->default(false);
            $table->enum(FieldName::STATUT, [Constant::BROUILLON, Constant::PUBLIE, Constant::DESACTIVE]);
            $table->timestamp(FieldName::DATE_BROUILLON);
            $table->timestamp(FieldName::DATE_PUBLICATION);
            $table->unsignedBigInteger(FieldName::CREATED_BY);
            $table->foreign(FieldName::CREATED_BY)->references(FieldName::ID)->on(TableName::ADMINISTRATEURS)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::SITES_TOURISTIQUES);
    }
};
