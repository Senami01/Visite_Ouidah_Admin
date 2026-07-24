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
        Schema::create(TableName::ACTEURS_MOBILE, function (Blueprint $table) {
            $table->id();
            $table->enum(FieldName::TYPE, [Constant::GUIDE, Constant::AGENCE, Constant::HOTEL, Constant::RESTAURANT]);
            $table->string(FieldName::DENOMINATION);
            $table->string(FieldName::NUMERO);
            $table->string(FieldName::EMAIL, 150)->unique();
            $table->string(FieldName::TELEPHONE);
            $table->string(FieldName::SITE_WEB);
            $table->text(FieldName::ADRESSE);
            $table->decimal(FieldName::LATITUDE, 10, 8);
            $table->decimal(FieldName::LONGITUDE, 11, 8);
            $table->text(FieldName::A_PROPOS);
            $table->string(FieldName::LANGUES_PARLEES);
            $table->string(FieldName::SPECIALITES);
            $table->date(FieldName::DATE_AGREMENT);
            $table->enum(FieldName::STATUT,[Constant::EN_ATTENTE, Constant::ACTIF, Constant::SUSPENDU, Constant::INACTIF]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::ACTEURS_MOBILE);
    }
};
