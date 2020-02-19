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
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->boolean('admin_menu')->default(false);
            $table->string('position');
            $table->string('custom_links')->nullable();
            $table->string('custom_title')->nullable();
            $table->string('custom_url')->nullable();
            $table->string('target')->nullable();
            $table->integer('menu_order')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('publish')->default(false);
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
        Schema::dropIfExists('menus');
    }
}
