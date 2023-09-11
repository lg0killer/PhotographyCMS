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
        Schema::create('barometers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('month');
            $table->string('points');
            $table->foreignIdFor(\App\Models\User::class, 'user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barometers');
    }
};
