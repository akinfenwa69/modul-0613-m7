<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('targetas', function (Blueprint $table) {
            $table->id();
            $table->string('nom_titular');
            $table->string('numero_compte');
            $table->date('data_validesa');
            $table->string('cvv');
            $table->enum('tipus_targeta', ['VISA', 'MASTERCARD', 'AMEX']);
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('targetas');
    }
};
