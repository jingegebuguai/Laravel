<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i=0;$i<50;$i++){
            $temp = [];
            $temp['username'] = str_random(3);
            $temp['password'] = Hash::make('iloveyou');
            $temp['email'] = str_random(4).'@qq.com';
            $phone = '';
            for($j=0;$j<11;$j++){
                $phone .= rand(1,9);
            }
            $temp['phone'] = $phone;
            $temp['level'] = 0;
            $temp['pic'] = '/image/upload/user.png';
            $temp['status']= 0;
            $data[] = $temp;
        }
        DB::table('users')->insert($data);
    }
}
