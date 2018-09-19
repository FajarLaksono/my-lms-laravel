<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('test_question_id')->index();
            $table->foreign('test_question_id')->references('id')->on('test_questions')->onDelete('cascade');
            $table->longText('text');
            $table->boolean('correct');
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
        Schema::dropIfExists('test_answers');
    }
}
