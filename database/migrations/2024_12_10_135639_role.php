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
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->timestamps();
        });

        // Insert default roles
        DB::table('role')->insert([
            [
                'id' => 1,
                'label' => 'Manager',
                'name' => 'manager'
            ],
            [
                'id' => 2, 
                'label' => 'Karyawan',
                'name' => 'karyawan'
            ],
            [
                'id' => 3,
                'label' => 'Viewers', 
                'name' => 'viewers'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
