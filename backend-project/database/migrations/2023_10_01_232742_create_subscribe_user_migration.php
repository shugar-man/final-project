<?php

use App\Models\User;
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
        Schema::create('subscribe_user', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(User::class);
            // $table->foreignIdFor(User::class);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('subscribe_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscribe_user');
    }
};
