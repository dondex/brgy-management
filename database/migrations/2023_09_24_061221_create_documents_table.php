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
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('document_id')->unique();
            $table->unsignedInteger('resident_id')->index();
            $table->enum('doc_type', ['bc', 'cor', 'cli'])->index();
            $table->string('purpose', 50)->index();
            $table->enum('status', ['approved', 'pending', 'declined'])->index();
            $table->enum('delivery', ['email', 'pick-up'])->index();
            $table->date('schedule')->index();
            $table->timestamps();

            $table->foreign('resident_id')->references('resident_id')->on('residents');
            $table->index(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
