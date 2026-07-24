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
        Schema::create(TableName::CARROUSEL_MEDIAS, function (Blueprint $table) {
            $table->id();
            $table->string(FieldName::TITRE);
            $table->enum(FieldName::TYPE, [Constant::IMAGE, Constant::VIDEO]);
            $table->string(FieldName::URL);
            $table->integer(FieldName::ORDRE);
            $table->enum(FieldName::STATUT, [Constant::BROUILLON, Constant::PUBLIE, Constant::MASQUE]);
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
        Schema::dropIfExists(TableName::CARROUSEL_MEDIAS);
    }
};
