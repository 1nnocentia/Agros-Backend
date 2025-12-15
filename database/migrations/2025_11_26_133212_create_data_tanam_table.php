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
        Schema::create('data_tanam', function (Blueprint $table) {
            $table->id();
            $table->date('planting_date')->isNotEmpty;

            $table->foreignId('lahan_id')->constrained('lahan')->onDelete('cascade')->index()->isNotEmpty;
            $table->foreignId('varietas_id')->constrained('varietas')->onDelete('cascade')->isNotEmpty;
            $table->foreignId('status_tanam_id')->constrained('status_tanam')->onDelete('cascade')->isNotEmpty;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_tanam');
    }
};
