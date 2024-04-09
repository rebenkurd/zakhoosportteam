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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('poll_categories');
            $table->foreignId('created_by')->constrained('users');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->enum('status',['pending','started','finished'])->default('pending');
            $table->enum('display',['show','hide'])->default('hide');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
