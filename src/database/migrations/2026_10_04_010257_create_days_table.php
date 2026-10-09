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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baby_id')->constrained('babies');
            $table->date('day');
            $table->string('memo')->nullable();
            $table->timestamps();
            $table->unique(['baby_id','day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
