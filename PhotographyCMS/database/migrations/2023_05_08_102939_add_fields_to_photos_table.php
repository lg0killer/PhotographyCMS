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
        Schema::table('photos', function (Blueprint $table) {
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->string('image_path');
            $table->integer('score')->nullable();
            $table->date('submitted_at')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('slug')->nullable();
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
            $table->string('location')->nullable();
            $table->string('camera')->nullable();
            $table->string('lens')->nullable();
            $table->string('focal_length')->nullable();
            $table->string('shutter_speed')->nullable();
            $table->string('aperture')->nullable();
            $table->string('iso')->nullable();
            $table->string('taken_at')->nullable();
            $table->string('published')->nullable();
            $table->string('featured')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('photos',[
            'name',
            'description',
            'image',
            'image_path',
            'thumbnail',
            'submitted_at',
            'score',
            'alt_text',
            'slug',
            'category',
            'tags',
            'location',
            'camera',
            'lens',
            'focal_length',
            'shutter_speed',
            'aperture',
            'iso',
            'taken_at',
            'published',
            'featured',
            'status',
        ]);
    }
};
