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
        Schema::create('calculation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_id')->required();
            $table->foreignId('detail_grading_id')->required();
            // $table->integer('nilai_profil')->required();
            $table->integer('nilai_profil_standard')->required();
            $table->integer('gap_awal')->required();
            $table->integer('gap_konversi')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculation_details');
    }
};
