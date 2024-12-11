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
        Schema::create('qc_air_cup', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->json('date')->nullable();
            $table->json('data')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('shift', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qc_air_cup');
    }
};
