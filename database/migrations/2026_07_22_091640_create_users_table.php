<?php

use App\Lib\Constant;
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
        Schema::create(TableName::USERS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::NOM);
            $table->string(FieldName::PRENOM)->nullable();
            $table->string(FieldName::EMAIL, 150)->unique(); 
            $table->string(FieldName::TELEPHONE, 20);
            $table->string(FieldName::DENOMINATION)->nullable();
            $table->string(FieldName::SITE_WEB)->nullable();
            $table->text(FieldName::ADRESSE)->nullable();
            $table->decimal(FieldName::LATITUDE, 10, 8)->nullable();
            $table->decimal(FieldName::LONGITUDE, 11, 8)->nullable();
            $table->text(FieldName::A_PROPOS)->nullable();
            $table->string(FieldName::LANGUES_PARLEES)->nullable();
            $table->string(FieldName::SPECIALITES)->nullable();
            $table->date(FieldName::DATE_AGREMENT)->nullable();
            $table->enum(FieldName::TYPE,[Constant::ADMINISTRATEUR, Constant::ACTEUR_MOBILE]);
            $table->string(FieldName::PASSWORD);
            $table->foreignUuid(FieldName::ROLE_ID)->references(FieldName::ID)->on(TableName::ROLE);
            $table->boolean(FieldName::STATUT)->default(true);
            $table->enum(FieldName::TYPE_ACTEUR, [Constant::GUIDE, Constant::AGENCE, Constant::HOTEL, Constant::RESTAURANT])->nullable();
            $table->timestamp(FieldName::DERNIERE_CONNEXION)->nullable();
            $table->timestamp(FieldName::EMAIL_VERIFIE_LE)->nullable();
            $table->string(FieldName::OTP, 60)->nullable();
            $table->string(FieldName::EXPIRE_LE)->nullable();
            $table->string('refresh_token')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::USERS);
        Schema::dropIfExists(TableName::PASSWORD_RESET_TOKENS);
    }
};
