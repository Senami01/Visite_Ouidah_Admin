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
        Schema::create(TableName::VISITEURS, function (Blueprint $table) {
            $table->id();
            $table->string(FieldName::NOM);
            $table->string(FieldName::PRENOM);
            $table->string(FieldName::PAYS, 100);
            $table->string(FieldName::EMAIL, 150)->unique();
            $table->string(FieldName::TELEPHONE, 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::VISITEURS);
    }
};
