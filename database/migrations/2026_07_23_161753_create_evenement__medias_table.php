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
        Schema::create(TableName::EVENEMENT_MEDIAS, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::EVENEMENT_ID)->references(FieldName::ID)->on(TableName::EVENEMENTS)->cascadeOnDelete();
            $table->enum(FieldName::TYPE, [Constant::IMAGE, Constant::VIDEO]);
            $table->string(FieldName::URL);
            $table->integer(FieldName::ORDRE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::EVENEMENT_MEDIAS);
    }
};
