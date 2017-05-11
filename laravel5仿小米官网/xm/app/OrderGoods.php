<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    //
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function sku()
    {
        return $this->hasOne('App\Sku','id','sku_id');
    }
}
