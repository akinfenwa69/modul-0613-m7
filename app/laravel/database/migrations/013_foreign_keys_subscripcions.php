<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscripcions', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('targeta_id')->constrained('targetas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('subscripcions', function (Blueprint $table) {
            $table->dropColumn('client_id');
            $table->dropColumn('targeta_id');
        });
    }
};
