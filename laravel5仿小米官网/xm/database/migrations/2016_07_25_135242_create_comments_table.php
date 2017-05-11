<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment('主键自增id');
            $table->text('content')->comment('回复的内容');
            $table->integer('good_id')->comment('goods的id');
            $table->integer('user_id')->comment('用户的id');
            $table->integer('pid')->comment('父级id');
            $table->string('path')->comment('二级分类路径');
            $table->string('img')->comment('文章的主图');
            $table->string('star')->comment('评论星级');
            $table->string('useless')->comment('备注');
            $table->tinyInteger('status')->default(1)->comment('回复的状态');
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
        Schema::drop('comments');
    }
}
