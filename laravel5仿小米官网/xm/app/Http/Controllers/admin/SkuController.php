<?php

namespace App\Http\Controllers\admin;


use App\Cate;
use App\Good;
use App\Sku;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SkuController extends Controller
{
    public function getIndex()
    {

        $sku = Sku::all();


        return view('admin.sku.index',['title'=>'商品种类列表','skus'=>$sku]);

        /**没有sku列表页**/
    }
    public function getAdd(Request $request)
    {
        $data = $request->only('id');
        $good = Good::find($data['id']);

        return view('admin.sku.sku',['title'=>'编辑sku','good'=>$good]);
    }
    public function getEdit(Request $request)
    {
        $data = $request->only('id');

        $sku = Sku::find($data['id']);
        
        $good = Good::find($sku->good_id);
        
        

        return view('admin.sku.update',['title'=>'编辑sku','sku'=>$sku,'good'=>$good]);
    }
    
    public function getInsert(Request $request)
    {
        $data = $request->only('title','good_id');
       
        if(Sku::where('title',$data['title'])->get()->count()){
            echo Sku::where('good_id',$data['good_id'])->count();
        }else{
            echo '0';
        }
    }
    public function postInsert(Request $request)
    {
        
        $sku = new Sku();
        $data = $request->all();
        $sku->title = $data['title'];
        $sku->good_id = $data['good_id'];
        $sku->falsePrice = $data['falsePrice'];
        $sku->price = $data['price'];
        $sku->color = $data['color'];
        $sku->attr = $data['attr'];
        $sku->info = $data['info'];
        $sku->stock = $data['stock'];
        $sku->status = 1;

        if($_FILES['img']['error']==0)
        {
            $sku->img = self::uploadFile();

        }else{
            $sku->img = config('app.upload_image_dir').'sku.png';
        }

        $sku->save();
    }



    public static function uploadFile()
    {
        $pic = $_FILES['img']['name'];
        $dir = config('app.upload_image_dir');
        $name = trim($dir.rand(1000000,9000000).time().'.'.pathinfo($pic,4),'.');
        Input::file('img')->move($dir,$name);
        return $name;
    }
    
    public function getAjaxEdit(Request $request)
    {
        $data = $request->only('title');
        $sku = Sku::where('title',$data['title'])->first();
        echo json_encode($sku);
    }

    public function postUpdate(Request $request)
    {
        $data = $request->all();
        $sku = Sku::find($data['id']);

        //判断用户名
        if($sku['title'] != $request->title) {

            if(Good::where('title','like', $request->title)->first()){

                return back()->with('error','文章标题已存在');

            }
        }
        $sku->title = $data['title'];
        $sku->good_id = $data['good_id'];
        $sku->falsePrice = $data['falsePrice'];
        $sku->price = $data['price'];
        $sku->color = $data['color'];
        $sku->attr = $data['attr'];
        $sku->info = $data['info'];
        $sku->stock = $data['stock'];
        $sku->status = 1;
        
        if($_FILES){
            self::updateFile();
            $sku->img = self::uploadFile();
        }

        $sku -> save();

        return back()->with('info','更新成功');
    }

    public static function updateFile()
    {
        $pic = Sku::select('img')->where('id',Input::only('id'))->first();

        $dbpic = '.'.$pic['img'];

        $defaultpic = config('app.upload_image_dir').'good.png';

        if($dbpic != $defaultpic)
        {

            if(file_exists(realpath($dbpic))){
                unlink(realpath($dbpic));
            }
                
          
        }
    }

    public function getAjaxDelete(Request $request)
    {
        
        
        $data = $request->only('title','good_id');

        if(Sku::where('title',$data['title'])->delete()){
            echo Sku::where('good_id',$data['good_id'])->count();
        }else{
            echo '0';
        }
    }
    public function getDelete(Request $request)
    {
        $data = $request->only('id');

        if(Sku::where('id',$data['id'])->delete())
        {
            return back()->with('info','删除成功');
        }
    }

}
