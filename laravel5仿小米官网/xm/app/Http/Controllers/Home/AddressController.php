<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Address;


class AddressController extends Controller
{
    //存储ajax返回的信息
    private $data = [];
    /**
     * ajax添加用户地址操作
     */
    public function getAdd(Request $request)
    {
        // dd($request->all());
        //获取登录用户的uid
        $uid = session('uid');
        $address = new Address;
        $address->user_id = $uid;
        $address->consignee = $request->input('uname');
        $address->tel = $request->input('phone');
        $address->province = $request->input('province');
        $address->city = $request->input('city');
        $address->district = $request->input('country');
        $address->postcode = $request->input('zipcode');
        $address->address = $request->input('address');

        if($address->save()){
            $this->data['status'] = 0;
            $this->data['msg'] = $address->id;
            echo json_encode($this->data);
            die;
        }else{
            $this->data['status'] = 1;
            $this->data['msg'] = '服务器出错,请稍后重试';
            echo json_encode($this->data);
            die;
        }
    }

    public function getDel(Request $request)
    {
        $ad_id = $request->input('id');

        $address = Address::find($ad_id);

        if($address->delete()){
            $this->data['status'] = 0;
            $this->data['msg'] = 'ok';
            echo json_encode($this->data);
        }else{
            $this->data['status'] = 1;
            $this->data['msg'] = '请刷新网页';
            echo json_encode($this->data);
            die;
        }
    }
    public static function getAddressByUid($uid)
    {
        $addresses = Address::where('user_id',$uid)->orderBy('id','desc')->get();

        if(!empty($addresses)){
            return $addresses;
        }

    }
}
