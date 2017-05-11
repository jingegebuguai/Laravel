<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\AddressController;

use App\Cart;
use App\Order;
use App\OrderGoods;
use App\Address;

class OrderController extends Controller
{
    //存储ajax信息
    private $data = [];
    private $allTotal = 0;
    private $num = 0;
    /**
     * 显示订单确认页
     */
    public function confirm()
    {   
        //获取用户id
        $uid = session('uid');
        $address = AddressController::getAddressByUid($uid);
        //获取购物商品的skuid
        $listItem = session('listItem');
 
        //获取购物车信息
        $carts = Cart::where('user_id',$uid)->whereIn('sku_id',$listItem)->get();
      
        //获取总件数 总价格
        $num = 0;
        $allTotal = 0;
        foreach($carts as $k=>$v){
            $num += $v->goods_num;
            $allTotal += $v->goods_num*$v->sku->price;
        }

        $pack_fee = 10;
        if($allTotal>99){
            $pack_fee = 0;
        }
        return view('home.order.confirm',[
                'address'=>$address,
                'carts'=>$carts,
                'num'=>$num,
                'allTotal'=>$allTotal,
                'pack_fee'=>$pack_fee,
            ]);

    }

    /**
     * ajax处理跳转到订单页 (购物车跳转)
     */
    public function postConfirm(Request $request)
    {
        $uid = session('uid');
        if(empty($uid)){
            $this->data['status'] = 2;
            $this->data['msg'] = '请登录';
            echo json_encode($this->data);
            die;
        }
        $listItem = $request->input('listItem');

        //将订单商品信息存入到session中
        if(empty($listItem)){
            $this->data['status'] = 4;
            $this->data['msg'] = '购物车为空';
            echo json_encode($this->data);
            die;
        }
        session(['listItem'=>$listItem]);
        \Session::save();

        //跳转去订单确认页面
        $this->data['status'] = 0;
        $this->data['msg'] = '/order/confirm';
        echo json_encode($this->data);
        die;
    }
    /**
     * 生成订单 (确认订单跳转到订单支付页)
     */
    public function postCreate(Request $request)
    {
        $uid = session('uid');
        $listItem = session('listItem');

        //获取购物车信息
        $carts = Cart::where('user_id',$uid)->whereIn('sku_id',$listItem)->get();

        //将该信息存入到order_goods数据库中
        // 开启事务处理
        \DB::beginTransaction();
        //生成订单信息插入到数据库中
        $order = new Order;
        $order->user_id = $uid;
        $order->order_status = 0;//初始化订单
        $order->pay_status = 0;//未支付
        $order->order_num = time('YmdHis').rand(100000,999999);//订单编号
        $order->pack_fee = $request->input('packFee');//运费
        $order->pack_time = 0;
        $order->total_price = $request->input('totalPrice');//总价
        //通过地址id添加下列信息
        $address = Address::find($request->input('addressId'));

        if(!empty($address)){
            $order->consignee = $address->consignee;
            $order->province = $address->province;
            $order->city = $address->city;
            $order->district = $address->district;
            $order->address = $address->address;
            $order->phone = $address->tel;
        }else{
            $this->data['status'] = 1;
            $this->data['msg'] = '服务异常,请稍后再试';
            echo json_encode($this->data);die;
            \DB::rollBack();
        }
        if(!$order->save()){
            $this->data['status'] = 2;
            $this->data['msg'] = '服务异常,请稍后再试';
            echo json_encode($this->data);die;
            \DB::rollBack();
        }
        //将商品信息插入到数据库中
        foreach($carts as $k=>$v){
            
            $orderGoods = new OrderGoods;
            $orderGoods->order_id = $order->id;
            $orderGoods->sku_id = $v->sku_id;
            $orderGoods->price = $v->sku->price;
            $orderGoods->num = $v->goods_num;
            $orderGoods->goods_name = $v->goods_name;
            $orderGoods->goods_attr = $v->goods_attr;
            $orderGoods->color = $v->sku->color;
            if(!$orderGoods->save()){
                $this->data['status'] = 3;
                $this->data['msg'] = '服务异常,请稍后再试';
                echo json_encode($this->data);die;
                \DB::rollBack();
            }else{
                $v->delete();
            }
        }

        //提交
        \DB::commit();
        //清楚session存储的订单sku id信息
        session(['listItem'=>null]);
        $this->data['status'] = 0;
        $this->data['msg'] = $order->id;
        echo json_encode($this->data);die;


    }

    public function getPay(Request $request)
    {
        //查询订单数据库
        $order = Order::where('order_status',0)->findOrFail($request->input('id'));
        //查询
        $beginTime = strtotime($order->created_at);
        $endTime = $beginTime + (48*3600);
        $nowTime = time();
        $countTime = floor(($endTime-$nowTime)/3600).'小时'.floor(($endTime-$nowTime)/60%60).'分';

     
        $request->session()->put('order.id',$order->id);
        $request->session()->put('order.totalPrice',$order->total_price);

        return view('home.order.pay',[
                'order'=>$order,
                'countTime'=>$countTime,
            ]);
    }
    /**
     * 发起支付请求
     */
    public function getPayfor(Request $request)
    {

        if($request->input('method'))
        {
            $url = '/order/changeStatus';
            return redirect($url);
        }
    }

    /**
     * 改变订单状态
     */
    public function changeStatus(Request $request)
    {
        //做验证
        //获取参数
        $status = $request->input('status');
        $orderid = $request->input('order_id');
        if($status=='00'){
            //获取验证信息
            $order = Order::where('order_status',0)->findOrFail($orderid);

            $order->order_status = 1;
            $order->pay_status = 1;

            if($order->save()){
                session(['order'=>null]);
                return view('home.order.success');
            }
        }

    }

}
