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
        Schema::create(TableName::SITE_HORAIRES, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::SITE_ID);
            $table->string(FieldName::JOUR);
            $table->time(FieldName::OUVERTURE);
            $table->time(FieldName::FERMETURE);
            $table->foreign(FieldName::SITE_ID)->references(FieldName::ID)->on(TableName::SITES_TOURISTIQUES)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::SITE_HORAIRES);
    }
};
