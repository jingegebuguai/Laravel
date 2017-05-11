<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public function cate()
    {
        return $this->belongsTo('App\Cate');
    }
    public function skus()
    {
        return $this->hasMany('App\Sku');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
