<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('test_id')->index();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->longText('text');
            $table->decimal('score')->nullable();
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
        Schema::dropIfExists('test_questions');
    }
}
