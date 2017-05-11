<?php

use Illuminate\Database\Seeder;

class Comment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
            $comment = new \App\Comment();
            $comment -> content = '我爱北京天安门,天安门前红旗升!';
            $comment -> good_id = mt_rand(1,9);
            $comment -> user_id = mt_rand(1,10);
            $comment -> pid = 0;
            $comment -> path = 0;
            $comment -> img = '';
            $comment -> star = 0;
            $comment -> useless = '';
            $comment -> status = 1;
            $comment -> save();
        }
    }
}
