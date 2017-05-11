<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Comment;
use App\Good;
use App\Sku;
use App\Address;

class UserController extends Controller
{
    public function getOrder(Request $request)
    {
        //获取用户id
        $uid = session('uid');

        //获取订单数据
        $orders = Order::where('user_id',$uid)
        ->where(function($query)use($request){
            $s = $request->input('s');
            if(!is_null($s)){
                if($s==0){
                    $query->where('order_status',$s);
                }else if($s==1){
                    $query->where('order_status','=',1);
                }else if($s==2){
                    $query->where('order_status','=',2);
                }
            }
        })
        ->paginate(4);

        $order = Order::where('user_id',$uid)->get();

        $info = $this->dealTmp($orders);
        $info .= $orders->appends($request->all())->render();
        return view('home.user.order',[
            'orders'=>$orders,
            'order'=>$order,
            'info'=>$info,
        ]);
    }
    /**
     * 确认收货
     */
    public function getPackin(Request $request)
    {
        $uid = session('uid');
        $id = $request->input('id');
       
         $order = Order::findOrFail($id);
         $order->order_status = 3;
         if($order->save()){
            return redirect('/user/comment?filter=1');
         }else{
            return back()->with('info','确认收货失败');
         }
    }
    /**
     * 处理模板
     */
    private function dealTmp($orders)
    {
        $str = '<ul class="order-list">';

        foreach ($orders as $key => $val){
            $status = $val->order_status;
            // $str .= $status;
            if($status == 0){
                $class = 'uc-order-item-pay';
                $samaury = '<div class="order-summary">
                            <div class="order-status">等待付款</div>
                            <p class="order-desc J_deliverDesc">
                                现在支付，预计2-3天送达
                                <span class="beta">Beta</span>
                            </p>
                        </div>';
                $action ='
                        <td class="order-actions">
                            <a class="btn btn-small btn-primary" href="/order/pay?id='.$val->id.'" target="_blank">立即支付</a>
                            <!--<a class="btn btn-small btn-line-gray" href="user/orderView?id='.$val->id.'">订单详情</a>-->
                        </td>';
            }elseif($status == 6) {
                $class = 'uc-order-item-shipping';
                $samaury = '<div class="order-summary"> <div class="order-status">已退款</div>   </div>';
                $action ='
                        <td class="order-actions">
                            <!--<a class="btn btn-small btn-line-gray" href="user/orderView?id='.$val->id.'">订单详情</a>-->
                        </td>';
            }else{
                $class = 'uc-order-item-finish';
                switch($status){
                    case 1:
                        $name = '未发货';
                    break;
                    case 2:
                        $name = '待收货';
                    break;
                    case 3:
                        $name = '已收货';
                    break;
                    case 4:
                        $name = '退货中';
                    break;
                    case 7:
                        $name = '已收货';
                    break;
                    default:
                        $name = '';
                }
                $samaury = '<div class="order-summary"> <div class="order-status">'.$name.'</div>     </div>';
                $action ='
                        <td class="order-actions">
                            <!--<a class="btn btn-small btn-line-gray" href="user/orderView?id='.$val->id.'">订单详情</a>-->';
                $action .= $status==2? '<a class="btn btn-small  btn-primary" href="/user/packin?id='.$val->id.'">确认收货</a>':''; 
                if($status==3){
                    
                }               
                $action .='</td>';
            }
            $str .='<li class="uc-order-item '.$class.'">
                    <div class="order-detail">';   
                    $str .= $samaury;   
                    $str .='<table class="order-detail-table">
                            <thead>
                                <tr>
                                    <th class="col-main">
                                        <p class="caption-info">
                                            '.date('Y年m月d日 H:i',strtotime($val->created_at)).'
                                            <span class="sep">|</span>
                                            '.$val->consignee.'
                                            <span class="sep">|</span>
                                            订单号：
                                            <a href="/user/orderView?num='.$val->order_num.'">'.$val->order_num.'</a>
                                            <span class="sep">|</span>
                                            在线支付
                                        </p>
                                    </th>
                                    <th class="col-sub">
                                        <p class="caption-price">
                                            订单金额：
                                            <span class="num">'.$val->total_price.'</span>
                                            元
                                        </p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="order-items">
                                        <ul class="goods-list">';
                                        foreach($val->orderGoods as $k=>$v){
                                            
                                            $str .='<li>
                                                <div class="figure figure-thumb">
                                                    <a href="/detail?id='.$v->sku->good->id.'" target="_blank">
                                                        <img src="'.$v->sku->img.'" width="80" height="80" alt="'.$v->goods_name.'"></a>
                                                </div>
                                                <p class="name">
                                                    <a target="_blank" href="/detail?id='.$v->sku->good->id.'">'.$v->goods_name.'</a>
                                                </p>
                                                <p class="price">'.$v->price.'元 × '.$v->num.'</p>
                                            </li>';
                                        }            
                                       $str .= '</ul>
                                    </td>';
                                    $str .=$action;
                                $str .='</tr>
                            </tbody>
                        </table>
                    </div>
                </li>';
        }
        $str .='</ul>';
        return $str;
    }
    /**
     * 显示收货地址
     */
    public function getAddress(Request $request)
    {
        //获取用户的uid
        $uid = session('uid');
        //获取address
        $address = Address::where('user_id',$uid)->get();
        return view('home.user.address',[
            'address'=>$address,
        ]);
    }

     /**
     * 显示个人中心评价页
     */
    public function getComment(Request $request)
    {
        //获取用户id
        $uid = session('uid');
        //获取用户已经确认收货或者订单完成却未评价的订单信息
        $orders = Order::whereIn('order_status',[3,7])->where('user_id',$uid)->get();
        //获取订单相关商品信息

        $goodsInfo = [];

        foreach($orders as $key => $value){
            $temp = [];
            $temp['order_num'] = $value->order_num;
            $temp['order_id'] = $value->id;
            $goodsID = []; 
            $skuId = [];
            foreach($value->orderGoods as $k=>$v)
            {   
                $goodsID[] = $v->sku->good->id;
                $skuId[] = $v->sku_id;
            }
            $temp['goods_id'] = $goodsID;
            $temp['sku_id'] = $skuId;
            $goodsInfo[] = $temp;
        }
        //判断商品是否已经评价过了
        // dd($goodsInfo);
        $goodsCmtNo = [];//没评论过的订单信息
        $goodsCmtYes = [];//评论过的订单信息        
        foreach ($goodsInfo as $k => $v) {
            //评论中是否存在订单号,商品id相同的 存在就是评价过的
            $comment = Comment::whereIn('good_id',$v['goods_id'])->where("useless",'=',$v['order_id'])->where('user_id',session('uid'))->get();

            if(empty($comment[0])){
                $goodsCmtNo[] = $v;
            }else{
                $goodsCmtYes[] = $v;
            }

        }

        //获取评论过的商品数据
        $goodsYes = [];
        foreach($goodsCmtYes as $k=>$v){
                
            foreach($v['sku_id'] as $key=>$val){
                $goodsYes[] = Sku::find($val);
            }
        }
        //获取未评论过的商品数据
        $goodsNo = [];
        foreach($goodsCmtNo as $k=>$v){
            foreach($v['sku_id'] as $key=>$val){
                $sku = Sku::find($val);
                $sku['order_id'] = $v['order_id'];
                $goodsNo[] = $sku;
                // $goodsNo[$k]['item'][] = Sku::find($val);
                // $goodsNo[$k]['order_id'] = $v['order_id'];

            }
        }
        // dd($goodsCmtNo);
        // dd($goodsCmtYes);
        return view('home.user.comment',[
            'request'=>$request,
            'goodsNo'=>$goodsNo,
            'goodsCmtNo'=>$goodsNo,
            'goodsYes'=>$goodsYes,
            'goodsCmtYes'=>$goodsYes,
            ]);
    }
    /**
     * 退出登录
     */
    public function getLogout(Request $request)
    {
        session(['uid'=>null]);
        $request->session()->flush();
        return back();
    }

    /**
     * 获取用户信息
     */
    public static function gainUsername()
    {
        $user = User::find(session('uid'));
        return $user;
    }

}
