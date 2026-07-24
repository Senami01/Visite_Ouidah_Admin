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
        Schema::create(TableName::ABONNEMENTS, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(FieldName::TYPE_ABONNEMENT_ID);
            $table->unsignedBigInteger(FieldName::ACTEUR_MOBILE_ID);
            $table->date(FieldName::DATE_DEBUT);
            $table->date(FieldName::DATE_FIN);
            $table->decimal(FieldName::MONTANT);
            $table->enum(FieldName::STATUT, [Constant::ACTIF, Constant::EXPIRE]);
            $table->foreign(FieldName::TYPE_ABONNEMENT_ID)->references(FieldName::ID)->on(TableName::TYPES_ABONNEMENT)->onDelete('cascade');
            $table->foreign(FieldName::ACTEUR_MOBILE_ID)->references(FieldName::ID)->on(TableName::ACTEURS_MOBILE)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TableName::ABONNEMENTS);
    }
};
