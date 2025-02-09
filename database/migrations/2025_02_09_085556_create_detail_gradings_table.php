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
        Schema::create('detail_gradings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grading_id')->required();
            $table->foreignId('criteria_id')->required();
            $table->foreignId('sub_criteria_id')->required();
            $table->integer('nilai_profil')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_gradings');
    }
};
