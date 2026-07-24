<?php

use App\Lib\FieldName;
use App\Lib\Constant;
use App\Lib\TableName;
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
        Schema::create(TableName::UTILISATEURS_MOBILE, function (Blueprint $table) {
            $table->id();
            $table->string(FieldName::NOM);
            $table->string(FieldName::PRENOM);
            $table->string(FieldName::EMAIL, 150)->unique();
            $table->string(FieldName::TELEPHONE, 20);
            $table->string(FieldName::PAYS, 100);
            $table->string(FieldName::ROLE);
            $table->unsignedBigInteger(FieldName::ACTEUR_MOBILE_ID);
            $table->enum(FieldName::STATUT,[Constant::ACTIF, Constant::DESACTIVE]);
            $table->timestamp(FieldName::DERNIERE_CONNEXION);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::UTILISATEURS_MOBILE);
    }
};
