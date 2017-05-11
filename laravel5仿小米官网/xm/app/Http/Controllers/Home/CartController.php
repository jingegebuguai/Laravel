<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Good;
use App\Sku;

class CartController extends Controller
{
    //存储返回的数据信息
    public  $data = [];
    /**
     * session('cart') 是一个多维数组 键名 对应的是sku-id
     * sku-id对应的键值是一个数组 0=>代表sku-id
     * sku-id对应的键值是一个数组 0=>代表购物车商品数量
     * sku-id对应的键值是一个数组 0=>代表商品的good-id
     */
    public function getInit(){
        session(['uid'=>null]);
        session(['cart'=>null]);
        session(['listItem'=>null]);
    }
    public function getSe(){
        dd(session()->all());
    }
    public function getLg(){
        session(['uid'=>3]);
    }
    public function index()
    {
        //获取用户id
        // session(['uid'=>1]);
        // dd(session()->all());
        //判断用户是否登录
        $uid = session('uid');

        $listItem = '';
        $totalPrice = 0;

        if(!empty($uid)){//已经登录
            if(!empty(session('cart'))){
                //判断session中是否存在cart 存在就存放在数据库中
                foreach(session('cart') as $k=>$v){
                    
                    //查看购物车数据中是否存在该商品
                    $cart = Cart::where('user_id',$uid)->where('sku_id',$k)->first();
                    //处理不存在该商品的情况
                    if(empty($cart)){
                        //查询sku表信息
                        $sku = Sku::find($k);
                        $info = new Cart;
                        $info->user_id = $uid;
                        $info->sku_id =  $v[0];
                        $info->goods_id = $sku->good_id;
                        $info->goods_name = $sku->title;
                        $info->goods_attr = $sku->color;
                        $info->goods_num = $v[1];
                        if(!$info->save()){
                            echo '数据库出错';
                            die;
                        }
                    }else{
                        $cart->goods_num = $cart->goods_num + (int)($v[1]);
                        if(!$cart->save()){
                            echo '数据库出错';
                            die;
                        }
                    }
                }
            }
            //清空session中的购物车信息
            session(['cart'=>null]);
            //获取数据库中购物车的信息
            // $carts = Cart::where('user_id',$uid)->get();
            $carts = \DB::table('carts as a')
                    ->select(\DB::raw('a.id as cid,a.sku_id as sid,a.goods_id as gid,a.goods_num as num ,b.img as img,b.title as title,b.price as price,b.attr as attr'))
                    ->where('a.user_id',$uid)
                    ->leftJoin('skus as b','a.sku_id','=','b.id')
                    ->get();
            
            //获取购物车中商品的id
 
            foreach($carts as $k=>$v){
                $listItem .= $v->sid.',';
                $totalPrice += $v->num*$v->price;
            }
            $listItem = trim($listItem,',');
             
        }else{//未登录
            //判断购物车session中是否存在信息
            $carts = [];

            if(count(session('cart'))>0){
                //查询商品的信息                
                foreach(session('cart') as $k=>$v){
                    $sku = Sku::where('id',$v[0])->first();
                    $carts[] = $sku;
                }
                //获取购物车中商品的id
                // dd($carts[0]->price);
                foreach($carts as $k=>$v){
                    $listItem .= $v->id.',';
                    
                    $totalPrice += session('cart')[$v->id][1]* (int)($v->price);

                }
                
                $listItem = trim($listItem,',');
                
            }

        }

        
        
        //获取商品推荐
        $goods = $this->gainRecomGoods();
        
        return view('home.cart',[
                'carts'=>$carts,
                'goods'=>$goods,
                'listItem'=>$listItem,
                'totalPrice'=>$totalPrice,
            ]);
    }
    
    /**
     * 获取推荐商品
     */
    private function gainRecomGoods()
    {
        //获取评论最多商品id?????

        $goods = Good::take(10)->get();

        return $goods;
    }

    /**
     * 获取商品信息
     */
    public function getAddproduct(Request $request)
    {
        //获取用户id
        $uid = session('uid');
        
        //查找商品
        $sku = Sku::select('stock','id','price')->find($request->input('id'));
        //判断是超过库存
        if($sku->stock < $request->input('num')){
            $this->data['status'] = 1;//超过最大库存
            $this->data['msg'] = '已超过最大库存量'.$sku->stock.'件';
            $this->data['total'] = $sku->price;//价格小计
            $this->data['price'] = $sku->price;//当前价格
            $this->data['stock'] = $sku->stock;//当前价格
            echo json_encode($this->data);
            die;
        }
        //判断是否是未登录状态
        if(empty($uid)){
            //增加购物车商品数量

            $request->session()->forget('cart.'.($sku->id));
      
            $request->session()->push('cart.'.($sku->id), $sku->id);//0 代表 id
            $request->session()->push('cart.'.($sku->id), $request->input('num'));//1 代表 num
            $request->session()->push('cart.'.($sku->id), $sku->good_id);//2 代表 gid good_id
           
            //保存数据更改            
            \Session::save();
            
                
            //判断 该商品是否被选中 选中就更新总价
            $skus = $request->input('listItem');
            // 
            $alltotal = 0;
            if($skus&&in_array($request->input('id'),$skus)){
                
                $this->totalPriceBySession($skus,$alltotal,$sku,$request);

            }else if(empty($request->input('listItem'))){//未全选状态处理
                $this->data['nofollow'] = 'none';
                $this->data['alltotal'] = number_format(0,2);
            }else{
                $this->totalPriceBySession($skus,$alltotal,$sku,$request);
            }

                //成功返回的信息
                $this->data['status'] = 0;
                $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
                $this->data['price'] = number_format($sku->price,2);//当前价格
                $this->data['msg'] = 'ok';
                echo json_encode($this->data); 
                die;
           
        }


        //跟新购物车表
        $cart = Cart::where('user_id',$uid)->where('sku_id',$request->input('id'))->first();
        $cart->goods_num = $request->input('num');
        if($cart->save()){
            //判断 该商品是否被选中 选中就更新总价
            $skus = $request->input('listItem');
            $alltotal = 0;
            if($skus&&in_array($request->input('id'),$skus)){
                //计算总价
                $this->totalPriceByDB($uid,$skus,$alltotal,$sku,$cart,$request);

            }else if(empty($request->input('listItem'))){//未全选状态处理
                $this->data['nofollow'] = 'none';;
                $this->data['alltotal'] = number_format(0,2);
            }else{
                //计算总价
                $this->totalPriceByDB($uid,$skus,$alltotal,$sku,$cart,$request);
            }

            $this->data['status'] = 0;
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['price'] = number_format($sku->price,2);//当前价格
            $this->data['msg'] = 'ok';
            echo json_encode($this->data); 
            die;
        }else{
            $this->data['status'] = 4;
            $this->data['price'] = number_format($sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$cart->goods_num,2);//价格小计
            $this->data['msg'] = '数据库出错';
            echo json_encode($this->data); 
            die;
        }

    }

    /**
     * 通过session获取购物车选择商品总价
     */
    private function totalPriceBySession($skus,$alltotal,$sku,$request)
    {
        foreach($skus as $k=>$v){
              
            $sku_2 = Sku::where('id',$v)->first();

            
            if(!empty($sku_2)){

                $alltotal += session('cart')[$v][1]*$sku_2->price;
               
            }else{
                $this->data['status'] = 2;
                $this->data['msg'] = '查不到商品信息';
                $this->data['price'] = $sku->price;//当前价格单价
                $this->data['total'] = $sku->price*$request->input('num');
                echo json_encode($this->data);
                die;
            }
            
        }
        
        //计算总价
        if(!empty($alltotal)&&is_numeric($alltotal)){
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            $this->data['price'] = number_format($sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['alltotal'] = number_format($alltotal,2);
            echo json_encode($this->data);
            die;
        }else{
            $this->data['status'] = 3;
            $this->data['msg'] = '未知错误';
            $this->data['price'] = number_format($sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['alltotal'] = '未知错误,请刷新页面';
            echo json_encode($this->data);
            die;
        }
    }

    /**
     * 通过数据库获取购物车选择商品总价
     */
    private function totalPriceByDB($uid,$skus,$alltotal,$sku,$cart,$request)
    {

        foreach($skus as $k=>$v){
            $cart2 = Cart::where('user_id',$uid)->where('sku_id',$v)->first();
            if(!empty($cart2)){
                $alltotal += $cart2->goods_num*$cart2->sku->price;
            }else{
                $this->data['status'] = 2;
                $this->data['msg'] = '查不到商品信息';
                $this->data['price'] = number_format($sku->price,2);//当前价格单价
                $this->data['total'] = number_format($sku->price*$request->input('num'),2);
                echo json_encode($this->data);
                die;
            }
            
        }
        //计算总价
        if(!empty($alltotal)&&is_numeric($alltotal)){
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            $this->data['price'] = number_format($cart->sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['alltotal'] = number_format($alltotal,2);
            echo json_encode($this->data);
            die;
        }else{
            $this->data['status'] = 3;
            $this->data['msg'] = '未知错误';
            $this->data['price'] = number_format($cart->sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['alltotal'] = '未知错误,请刷新页面';
            echo json_encode($this->data);
            die;
        }

    }
    public function getAllTotal(Request $request)
    {
        $uid = session('uid');
        $skus = $request->input('listItem');
        $alltotal = 0;
        if(empty($uid)){

            foreach($skus as $k=>$v){
          
                $sku_2 = Sku::where('id',$v)->first();

                
                if(!empty($sku_2)){

                    $alltotal += session('cart')[$v][1]*$sku_2->price;
                   
                }else{
                    $this->data['status'] = 2;
                    $this->data['msg'] = '查不到商品信息';
                    echo json_encode($this->data);
                    die;
                }
                
            }
            
            //计算总价
            if(!empty($alltotal)&&is_numeric($alltotal)){
                $this->data['status'] = 0;
                $this->data['msg'] = 'ok';
                $this->data['price'] = number_format($sku->price,2);//当前价格
                $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
                $this->data['alltotal'] = number_format($alltotal,2);
                echo json_encode($this->data);
                die;
            }else{
                $this->data['status'] = 3;
                $this->data['msg'] = '未知错误';
                $this->data['price'] = number_format($sku->price,2);//当前价格
                $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
                $this->data['alltotal'] = '未知错误,请刷新页面';
                echo json_encode($this->data);
                die;
            }
        }
        //登录状态下查询
        foreach($skus as $k=>$v){
            $cart2 = Cart::where('user_id',$uid)->where('sku_id',$v)->first();
            if(!empty($cart2)){
                $alltotal += $cart2->goods_num*$cart2->sku->price;
            }else{
                $this->data['status'] = 2;
                $this->data['msg'] = '查不到商品信息';
                $this->data['price'] = number_format($sku->price,2);//当前价格单价
                $this->data['total'] = number_format($sku->price*$request->input('num'),2);
                echo json_encode($this->data);
                die;
            }
            
        }
        //计算总价
        if(!empty($alltotal)&&is_numeric($alltotal)){
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            $this->data['price'] = number_format($cart->sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['alltotal'] = number_format($alltotal,2);
            echo json_encode($this->data);
            die;
        }else{
            $this->data['status'] = 3;
            $this->data['msg'] = '未知错误';
            $this->data['price'] = number_format($cart->sku->price,2);//当前价格
            $this->data['total'] = number_format($sku->price*$request->input('num'),2);//价格小计
            $this->data['alltotal'] = '未知错误,请刷新页面';
            echo json_encode($this->data);
            die;
        }

    }

    public function getDelcart(Request $request)
    {
        //删除指定项listItem
        $listItem = $request->input('listItem');
        if(in_array($request->input('id'),$listItem)){
            $key = array_search($request->input('id'),$listItem);
            unset($listItem[$key]);

        }
        $carts = Sku::whereIn('id',$listItem)->get();
        $alltotal = 0;
        foreach($carts as $k=>$v){
            $alltotal += $v->price * session('cart.'.$v->id)[1];
        }

        if(!empty(session('cart')))
        {

            $request->session()->forget('cart.'.$request->input('id'));
            // session(['cart'.$request->input('id')=>null]);
            \Session::save();
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            $this->data['alltotal'] = $alltotal;
            echo json_encode($this->data);
            die;
        }

        // $skuid = $request->input('id');
        // $cart = Cart::where('user_id',session('uid'))->where('sku_id',$skuid)->first();
        $cart = Cart::find($request->input('id'));
       
        if(empty($cart)){
            $this->data['status'] = 1;
            $this->data['msg'] = '查无该产品';
            echo json_encode($this->data);
            die;
        }
        if($cart->delete()){
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            $this->data['alltotal'] = $alltotal;
            echo json_encode($this->data);
            die;
        }else{
            $this->data['status'] = 2;
            $this->data['msg'] = '删除失败';
            echo json_encode($this->data);
            die;
        }
    }

    /**
     * 加入购物车操作
     */
    public function ajaxAddCart(Request $request){

        //判断是否登录
        $uid = session('uid');
        $sku = Sku::where('good_id',$request->input('good_id'))->where('price',$request->input('sku_price'))->where('color',$request->input('sku_color'))->where('attr',$request->input('sku_attr'))->first();
        //$sku = Sku::find($request->input('id'));
        //未登录情况将购物车信息加入到session中
        if(empty($uid)){
            //先判断是否存在
            if(empty(session('cart')[$sku->id])){
//         dd(11);
                $request->session()->push('cart.'.($sku->id), $sku->id);//0 代表 id
                $request->session()->push('cart.'.($sku->id), $request->input('num'));//1 代表 num
                $request->session()->push('cart.'.($sku->id), $sku->good_id);//2 代表 gid good_id
                //保存修改过的session值
                \Session()->save();
                $this->data['status'] = 0;
                $this->data['msg'] = 'ok';
                echo json_encode($this->data);
//                die;

            }else{
//                dd(444);
                //修改session值
                $num = session('cart')[$sku->id][1];
                $request->session()->forget('cart.'.$sku->id);
                $request->session()->push('cart.'.($sku->id), $sku->id);//0 代表 id
                $request->session()->push('cart.'.($sku->id),  $num+$request->input('num'));//1 代表 num
                $request->session()->push('cart.'.($sku->id), $sku->good_id);
                
                //保存修改过的session值
                \Session()->save();
                $this->data['status'] = 0;
                $this->data['msg'] = 'ok';
                echo json_encode($this->data);
//                die;

            }
            

        }

        //dd($sku);
        //已经登录 将数据插入到数据库中
//        dd($uid);
        if(!empty($uid)){
//            dd(1);
            //查看购物车数据中是否存在该商品
            $cart = Cart::where('user_id',$uid)->where('sku_id',$sku->id)->first();
            //处理不存在该商品的情况
            if(empty($cart)){

                $info = new Cart;
                $info->user_id = $uid;
                $info->sku_id = $sku->id;
                $info->goods_id = $request->input('good_id');
                $info->goods_name = $sku->title;
                $info->goods_attr = $sku->color;
                $info->goods_num = $request->input('num');
                if($info->save()){
                    $this->data['status'] = 0;
                    $this->data['msg'] = 'ok';
                    echo json_encode($this->data);
                    die;
                }else{
                    $this->data['status'] = 1;
                    $this->data['msg'] = '操作失败,请重试';
                    echo json_encode($this->data);
                    die;
                }

            }else{

                $cart->goods_num = $cart->goods_num + (int)($sku->$request->input('num'));
                if($cart->save()){
                    $this->data['status'] = 0;
                    $this->data['msg'] = 'ok';
                    echo json_encode($this->data);
                    die;
                }else{
                    $this->data['status'] = 1;
                    $this->data['msg'] = '操作失败,请重试';
                    echo json_encode($this->data);
                    die;
                }
            }

        }

    }

    /**
     * 添加数据到购物车的操作
     */
    private function addToCart($request)
    {
        
    }
}
