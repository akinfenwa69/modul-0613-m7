<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('valoracions', function (Blueprint $table) {
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('valoracions', function (Blueprint $table) {
            $table->dropColumn('classe_id');
            $table->dropColumn('client_id');
        });
    }
};
