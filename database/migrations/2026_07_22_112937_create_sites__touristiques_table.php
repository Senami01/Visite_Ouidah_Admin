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
        Schema::create(TableName::SITES_TOURISTIQUES, function (Blueprint $table) {
            
        $table->uuid(FieldName::ID)->primary();
        $table->string(FieldName::NOM)->nullable(false); 
        $table->string(FieldName::CATEGORIE)->nullable(); 
        $table->decimal(FieldName::LATITUDE, 10, 8)->nullable(); 
        $table->decimal(FieldName::LONGITUDE, 11, 8)->nullable(); 
        // 💡 Ajout de ->nullable() sur les champs secondaires pour éviter les erreurs PostgreSQL
        $table->text(FieldName::ACCES)->nullable();
        $table->text(FieldName::COURTE_DESCRIPTION)->nullable();
        $table->string(FieldName::A_PROPOS_TITRE)->nullable();
        $table->text(FieldName::A_PROPOS_DESCRIPTION)->nullable();
        $table->text(FieldName::CONSEILS_PRATIQUES)->nullable();
        $table->text(FieldName::INDICATIONS)->nullable();
        $table->enum(FieldName::TYPE_TARIFICATION, [Constant::UNIQUE, Constant::DOUBLE])->nullable();
        $table->boolean(FieldName::OUVERT_24_7)->default(false);
        $table->enum(FieldName::STATUT, [Constant::BROUILLON, Constant::PUBLIE, Constant::DESACTIVE])->default(Constant::BROUILLON);
        $table->timestamp(FieldName::DATE_BROUILLON)->nullable();
        $table->timestamp(FieldName::DATE_PUBLICATION)->nullable();
        // Clés étrangères (ajoutez ->nullable() si un site n'est pas forcément lié à un acteur mobile au départ)
        $table->foreignUuid(FieldName::CREATED_BY)->references(FieldName::ID)->on(TableName::USERS)->cascadeOnDelete();
        $table->foreignUuid(FieldName::ACTEUR_MOBILE_ID)->nullable()->references(FieldName::ID)->on(TableName::UTILISATEURS_MOBILE)->cascadeOnDelete();
        
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
