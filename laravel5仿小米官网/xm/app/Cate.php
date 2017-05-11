<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //类与商品为1对多关系
    public function goods()
    {

        return $this->hasMany('App\good');
    }
    //类与sku为远层1对多关系
    public function Skus()
    {
        return $this->hasManyThrough('App\sku','App\good');
    }
    
}
