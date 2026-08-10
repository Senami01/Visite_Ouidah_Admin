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
        Schema::create(TableName::ADMINISTRATEURS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::NOM);
            $table->string(FieldName::PRENOM);
            $table->string(FieldName::EMAIL, 150)->unique(); 
            $table->string(FieldName::TELEPHONE, 20);
            $table->text(FieldName::ADRESSE_RESIDENCE);
            $table->string(FieldName::MOT_DE_PASSE_HASH);
            $table->foreignUuid(FieldName::ROLE_ID)->references(FieldName::ID)->on(TableName::ROLE);
            $table->boolean(FieldName::STATUT)->default(true);
            $table->timestamp(FieldName::DERNIERE_CONNEXION);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::ADMINISTRATEURS);
    }
};
