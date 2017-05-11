<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function orderGoods()
    {
        return $this->hasMany('App\OrderGoods');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    } 
}
