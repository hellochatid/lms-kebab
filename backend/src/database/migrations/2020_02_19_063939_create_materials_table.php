<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lesson_id')->references('id')->on('lessons');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->longText('content');
            $table->string('tag')->nullable();
            $table->string('image')->nullable();
            $table->string('pdf')->nullable();
            $table->string('audio')->nullable();
            $table->string('video')->nullable();
            $table->integer('order')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->bigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
