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
        Schema::create('email_audits', function (Blueprint $table) {
            $table->id();
            $table->string('message_id');
            $table->string('subject')->nullable();
            $table->text('to')->nullable();
            $table->text('from')->nullable();
            $table->text('bcc')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->tinyInteger('sent')->nullable()->default(0);
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_audits');
    }
};
