<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscripcions', function (Blueprint $table) {
            $table->id();
            $table->enum('tipus', ['Bàsica', 'Premium', 'VIP']);
            $table->decimal('preu', 8, 2);
            $table->date('data_inici');
            $table->date('data_fi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscripcions');
    }
};
