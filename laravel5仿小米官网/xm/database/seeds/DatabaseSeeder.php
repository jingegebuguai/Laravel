<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call(User::class);
        $this->call(Good::class);
        $this->call(Cate::class);
        $this->call(Sku::class);
        $this->call(Comment::class);

        Model::reguard();
    }
}
