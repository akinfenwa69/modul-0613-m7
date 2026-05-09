<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('valoracions', function (Blueprint $table) {
            $table->id();
            $table->string('descripcio');
            $table->integer('estrelles');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valoracions');
    }
};
