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
            $table->id();
            $table->unsignedBigInteger(FieldName::EVENEMENT_ID);
            $table->enum(FieldName::TYPE, [Constant::IMAGE, Constant::VIDEO]);
            $table->string(FieldName::URL);
            $table->integer(FieldName::ORDRE);
            $table->foreign(FieldName::EVENEMENT_ID)->references(FieldName::ID)->on(TableName::EVENEMENTS)->onDelete('cascade');
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
