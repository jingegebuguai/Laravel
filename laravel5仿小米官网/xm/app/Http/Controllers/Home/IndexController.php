<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Cate;
use App\Good;
use App\Sku;
class IndexController extends Controller
{
    public function index()
    {
        
        //获取明星产品信息
        $star = null;
        if(file_exists('./data/stargoods.json')){
            $star = file_get_contents('./data/stargoods.json');

            $star = json_decode($star);
        }
        $smarty = $this->allGoods(1);
        // dd($smarty);
        return view('home.index',[
            'star'=>$star,
            'smarty'=>$smarty,
        ]);
    }


    /**
     * 获取一类底下的所有商品
     * $cate_id 类的id
     * 只能获取两层
     */
    private function allGoods($cate_id)
    {
        //声明一个变量接收商品
        $data = [];
        //去goods表中查询所有该类下的所有商品信息
        $goods = Good::where('cate_id',$cate_id)->get()->toArray();
        
        //去分类表中获取他所有子类 子类商品也是属于该类商品的
        $cates = Cate::where('pid',$cate_id)->get();

        //遍历类获取子类商品
        foreach($cates as $k=>$v){
            $temp = Good::where('cate_id',$v->id)->get()->toArray();
            if($temp){
                 $data = array_merge($data,$temp);
            }    
        }

        $data = array_merge($data,$goods);

        $data2 = [];
        //去sku表中表中遍历所有商品
        foreach($data as $key=>$val)
        {
            
            $temp2 = Sku::where('good_id',$val['id'])->get();
       
            if(count($temp2)){

                foreach($temp2 as $k=>$v){
                    $data2[] = $v;
                    //限定个数
                    if(count($data2)>8){
                        $data2 = array_slice($data2,0,8);
                        break 2;
                    }
                }

            } 
        }
        return $data2;
    }
}
