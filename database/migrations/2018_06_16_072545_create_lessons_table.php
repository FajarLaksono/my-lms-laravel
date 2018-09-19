<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id')->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->text('title');
            $table->string('slug', 100)->unique();
            $table->integer('position');
            $table->text('image')->nullable();
            $table->text('short_text')->nullable();
            $table->longText('full_text')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
