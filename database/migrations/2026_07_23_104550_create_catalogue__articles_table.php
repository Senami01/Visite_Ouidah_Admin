<?php

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
        Schema::create(TableName::CATALOGUE_ARTICLES, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::ACTEUR_MOBILE_ID);
            $table->string(FieldName::LIBELLE);
            $table->decimal(FieldName::COUT);
            $table->text(FieldName::DESCRIPTION);
            $table->string(FieldName::LIEN);
            $table->foreign(FieldName::ACTEUR_MOBILE_ID)->references(FieldName::ID)->on(TableName::ACTEURS_MOBILE)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::CATALOGUE_ARTICLES);
    }
};
