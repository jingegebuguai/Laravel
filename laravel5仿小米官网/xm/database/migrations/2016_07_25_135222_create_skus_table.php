<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键自增id');
            $table->tinyInteger('good_id')->comment('商品id');
            $table->string('title')->comment('名称');
            $table->string('attr')->comment('商品的参数');
            $table->string('color')->comment('商品颜色');
            $table->string('falsePrice')->comment('原价');
            $table->string('price')->comment('现价');
            $table->string('img')->comment('列表图');
            $table->text('info')->comment('商品的参数');
            $table->string('stock')->comment('库存');
            $table->tinyInteger('status')->comment('状态 0为下架 1为上架')->default(1);
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
        Schema::drop('skus');
    }
}
