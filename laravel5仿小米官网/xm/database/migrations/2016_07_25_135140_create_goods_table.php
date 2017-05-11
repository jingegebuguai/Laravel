<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键自增id');
            $table->string('title')->comment('商品的名称');
            $table->string('sub_title')->comment('副标题,优点介绍');
            $table->string('cate_id')->comment('商品的分类id');
            $table->decimal('price')->comment('商品列表显示的价格');
            $table->text('content')->comment('商品的内容');
            $table->text('img')->comment('商品的主图');
            $table->text('showImg')->comment('商品的主图');
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
        Schema::drop('goods');
    }
}
