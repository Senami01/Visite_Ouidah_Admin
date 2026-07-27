<?php

use App\Lib\Constant;
use App\Lib\FieldName;
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
        Schema::create(TableName::EVENEMENTS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->string(FieldName::TITRE);
            $table->text(FieldName::DESCRIPTION);
            $table->string(FieldName::LIEU);
            $table->timestamp(FieldName::DATE_DEBUT);
            $table->timestamp(FieldName::DATE_FIN);
            $table->string(FieldName::PAGE_WEB);
            $table->enum(FieldName::STATUT, [Constant::BROUILLON, Constant::PUBLIE, Constant::ARCHIVE]);
            $table->foreignUuid(FieldName::CREATED_BY)->references(FieldName::ID)->on(TableName::ADMINISTRATEURS)->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::EVENEMENTS);
    }
};
