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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('banner')->default('blue.png');
            // $table->string("username");
            $table->boolean('role')->default(false); // false = user
            $table->string('profile_image')->default('miku.jpg')->nullable();
            // $table->string('profile_image')->default('storage/cat.jpg')->nullable();
            $table->string('tel')->default('')->nullable();
            $table->boolean('status')->default(true); //user's status

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
