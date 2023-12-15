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
        Schema::create('officials', function (Blueprint $table) {
            $table->increments('official_id')->unique();
            $table->string('name', 60)->index();
            $table->enum('position', ['captain', 'secretary', 'treasurer', 'councilor', 'sk'])->index();
            $table->string('year', 11)->index();
            $table->string('img', 100)->index();
            $table->enum('status', ['current', 'archived'])->index();
            $table->timestamps();

            $table->index(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};
