<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id');
            $table->bigInteger('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->boolean('admin_menu')->default(false);
            $table->string('position');
            $table->string('custom_links');
            $table->string('custom_title');
            $table->string('custom_url');
            $table->string('target');
            $table->integer('menu_order');
            $table->string('icon');
            $table->boolean('publish')->default(false);
            $table->timestamps();
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
        Schema::dropIfExists('menus');
    }
}
