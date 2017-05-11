<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\HelpArticle;
use App\HelpCate;

class HelpController extends Controller
{
    //
    public function getArticle(Request $request)
    {
        $article = HelpArticle::where('status',1)->findOrFail($request->input('id'));
        if(empty($article)){
            abort(404);
        }

        
        return view('home.help.help',[
                'article'=>$article,
    
                'request'=>$request
            ]);
    }

    public static function getHelp()
    {
        $cates = HelpCate::where('status',1)->where('pid','<>',0)->where('show',1)->take(5)->get();

        return $cates;
    }
}
