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
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('resident_id');
            $table->unsignedInteger('user_id')->index();
            $table->string('firstname', 30)->index();
            $table->string('middlename', 30)->index();
            $table->string('lastname', 30)->index();
            $table->string('address', 200)->index();
            $table->date('birthdate')->index();
            $table->string('nationality', 30)->index();
            $table->enum('gender', ['male', 'female', 'lgbt'])->index();
            $table->enum('civil_status', ['single', 'married', 'widowed', 'separated'])->index();
            $table->string('occupation', 30)->index();
            $table->string('phone', 15)->index();
            $table->string('email', 50)->index();
            $table->string('valid_id', 200)->index();
            $table->enum('four_ps', ['yes', 'no'])->index();
            $table->enum('verified', ['yes', 'pending', 'no'])->index();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->index(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
