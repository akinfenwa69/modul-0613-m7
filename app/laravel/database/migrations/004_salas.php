<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->enum('tipus', ['Fuerza','Cardio','Yoga','Pilates','CrossFit','Spinning','Zumba','HIIT','Boxeo','Estiramientos', 'Natación', 'Stretching', 'Meditación', 'BodyPump', 'Ciclismo Indoor']);
            $table->string('descripcio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
