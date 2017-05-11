<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public function sku()
    {
        return $this->belongsTo('App\Sku');
    } 
}
