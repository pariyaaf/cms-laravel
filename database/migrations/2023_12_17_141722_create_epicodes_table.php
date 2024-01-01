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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('body');
            $table->string('videoUrl');
            $table->string('tags');
            $table->integer('viewCount')->default(0);
            $table->integer('commentCount')->default(0);
            $table->integer('downloadCount')->default(0);
            $table->integer('episodeNumber');
            $table->string('type',10);
            $table->string('time')->default('00:00:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
