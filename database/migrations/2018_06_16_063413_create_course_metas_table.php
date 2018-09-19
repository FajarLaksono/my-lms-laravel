<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id')->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('meta_key');
            $table->string('meta_value')->nullable();
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
        Schema::dropIfExists('course_metas');
    }
}
