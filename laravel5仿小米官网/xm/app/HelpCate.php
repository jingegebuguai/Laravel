<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpCate extends Model
{
    //
    public function helpArticle()
    {
        return $this->hasMany('App\HelpArticle','help_cate_id','id');
    }
}
