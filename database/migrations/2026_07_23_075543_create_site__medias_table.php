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
        Schema::create(TableName::SITE_MEDIAS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::SITE_ID);
            $table->enum(FieldName::TYPE, [Constant::IMAGE, Constant::VIDEO]);
            $table->string(FieldName::URL);
            $table->boolean(FieldName::EST_COUVERTURE);
            $table->integer(FieldName::ORDRE);
            $table->foreign(FieldName::SITE_ID)->references(FieldName::ID)->on(TableName::SITES_TOURISTIQUES)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::SITE_MEDIAS);
    }
};
