<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
   
   public $status = [
        '未付款',
        '已付款',
        '已发货',
        '确认收货',
        '退货中',
        '退款中',
        '退款完成',
        '订单完成',
   ];
   /**
    * 显示订单列表
    */
   public function getIndex(Request $request)
   {
        $order = Order::where(function($query)use($request){
            if(!empty($request->input('keywords'))){
                $query->where('order_num',$request->input('keywords'));
            }
        })->paginate($request->input('num',10));
        return view('admin.order.order',[
                'request'=>$request,
                'order'=>$order,
                'status'=>$this->status,
            ]);
   }
   /**
    * 显示订单状态编辑页面
    */
   public function getEdit(Request $request)
   {
        $id = $request->input('id');
        $order = Order::findOrFail($id);
        return view('admin.order.edit',[
                'order'=>$order,
                'status'=>$this->status
            ]);
   }
   /**
    * 订单编辑提交处理
    */
   public function postEdit(Request $request)
   {
        $id = $request->input('id');
        $order = Order::findOrFail($id);
        $order->order_status = $request->input('status');

        if($order->save())
        {
            return redirect('/admin/order')->with('info','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
   }
   /**
    * 显示订单详情
    */
   public function getDetail(Request $request)
   {
        $id = $request->input('id');
        $order = Order::findOrFail($id);

        return view('admin.order.detail',[
                'order'=>$order,
                'status'=>$this->status
            ]);
   }
}
