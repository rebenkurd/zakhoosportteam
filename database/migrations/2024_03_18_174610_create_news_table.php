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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('title_ckb');
            $table->string('title_ku');
            $table->string('image');
            $table->text('description_en');
            $table->text('description_ar');
            $table->text('description_ckb');
            $table->text('description_ku');
            $table->enum('status',['active', 'inactive'])->default('inactive');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
