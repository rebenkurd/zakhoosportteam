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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('age');
            $table->string('national')->nullable();
            $table->string('position');
            $table->foreignId('team_id')->nullable()->references('id')->on('teams')->onDelete('set null');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('foot')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->date('joined')->nullable();
            $table->date('contract_expires')->nullable();
            $table->tinyInteger('shirt_number')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
