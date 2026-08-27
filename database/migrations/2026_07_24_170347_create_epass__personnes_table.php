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
        Schema::create(TableName::EPASS_PERSONNES, function (Blueprint $table) {
            $table->uuid(FieldName::ID)->primary();
            $table->foreignUuid(FieldName::EPASS_ID)->references(FieldName::ID)->on(TableName::EPASSES)->cascadeOnDelete();
            $table->string(FieldName::NOM);
            $table->string(FieldName::PAYS);
            $table->enum(FieldName::TYPE_PIECE, [Constant::CNI, Constant::PASSEPORT, Constant::PERMIS, Constant::AUTRE]);
            $table->string(FieldName::NUMERO_PIECE);
            $table->string(FieldName::CATEGORIE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::EPASS_PERSONNES);
    }
};
