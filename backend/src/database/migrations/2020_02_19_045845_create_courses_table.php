<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->references('id')->on('categories')->default(1);
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('tag')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
