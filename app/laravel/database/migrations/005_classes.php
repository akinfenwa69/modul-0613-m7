<?php

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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipus', ['Yoga', 'Pilates', 'Spinning', 'Zumba', 'Crossfit', 'Boxeo', 'Aerobics', 'HIIT', 'Estiramientos', 'Natación', 'Stretching', 'Meditación', 'BodyPump', 'Ciclismo Indoor']);
            $table->string('descripcio');
            $table->time('horari_inici');
            $table->time('horari_final');
            $table->date('dia');
            $table->integer('places');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
