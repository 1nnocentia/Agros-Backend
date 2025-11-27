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
        Schema::create('data_panen', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_panen');
            $table->float('bobot_hasil');

            $table->foreignId('data_tanam_id')->constrained('data_tanams')->onDelete('cascade');
            $table->foreignId('status_panen_id')->constrained('status_panens')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_panen');
    }
};
