<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpArticle extends Model
{
    //
    public function helpCate()
    {
        return $this->belongsTo('App\HelpCate');
    } 
}
