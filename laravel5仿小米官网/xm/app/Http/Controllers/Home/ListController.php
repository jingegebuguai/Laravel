<?php

namespace App\Http\Controllers\Home;

use App\Cate;
use App\Good;
use App\Sku;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListController extends Controller
{

    public function detail(Request $request)
    {
//        dd($request->only('id'));

        $good = Good::find($request->only('id')['id']);

        if(!$good){
            echo '<script>alert("暂无数据");window.location.href="/";</script>';
            
        }
        $good->img = explode(',',$good->img);

        $skus = $good->skus ;

        $arr = [];
        foreach ($skus as $key => $value) {
            $arr[] = $value->attr;
        }

        $attr = array_unique($arr);

        $color = [];
        $info = [];

        $i = 0;
        foreach ($attr as $key => $value) {

            $info[$value] = Sku::where('attr',$value)->first()->info;

            foreach (Sku::where('attr',$value)->get() as $k => $v ){

                $color[$value][$k] = $v->color;
            }
            $i++;
        }

        $good->attr = $color;
        $good->info = $info;
        
//        dd($good->info);
        return view('home.detail',['good'=>$good,'title'=>'详情']);
    }


    
    public function list_(Request $request)
    {
        $data = $request->only('id');
        
        $cates = Cate::where('pid',$data)->get();

        $arr = [];

        foreach ($cates as $key => $value) {
            $arr[] = $value->id;
        }



        $goods = Good::whereIn('cate_id',$arr)->get();



        foreach ($goods as $key => $value) {
            $sub_title = sub_title();
            $value->sub_title =$sub_title;
        }


        
        return view('home.list',['goods'=>$goods,'title'=>'小米商城']);
    }

    public function List_Search(Request $request)
    {
        $data = $request->all();

//        dd($data['kWord']);

//        /**测试**/ $data['kWord'] = '手机'; /**结束**/

        $cates = Cate::where('pid',0)->get();


//        $cate = Cate::where('name','like','%'.$data['kWord'].'%')->where('pid',0)->get();
        $cate = Cate::where('name','like','%'.$data['kWord'].'%')->get();


//        dd($cate);

        $pid = [];

        foreach ($cate as $key => $value) {
            $pid[] = $value->id;
        }



        $cate = Cate::whereIn('pid',$pid)->get();


        if($cate->count()) {
            $id = [];
            foreach ($cate as $key => $value) {
                $id[] = $value->id;
            }
            $search_goods = Good::whereIn('cate_id',$id )->Get();

        }else{
            $search_goods = Good::whereIn('cate_id', $pid)->Get();
        }



        $goods = Good::take('10')->orderBy('created_at','desc')->get();

        return view('home.list_search',['cates'=>$cates,'search_goods'=>$search_goods,'goods'=>$goods,'title'=>'小米商城']);
    }

    
}
