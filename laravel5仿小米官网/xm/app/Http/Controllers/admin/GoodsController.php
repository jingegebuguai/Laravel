<?php

namespace App\Http\Controllers\admin;


use App\Cate;
use App\Good;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GoodsController extends Controller
{
    public function getIndex()
    {
        
        $goods = Good::all();
        
        return view('admin.goods.index',['goods'=>$goods,'title'=>'商品列表']);
    }
    public function getAdd()
    {
        $cates = Cate::all();
        return view('admin.goods.add',['cates'=>$cates,'title'=>'添加商品']);
    }
    public function postInsert(Request $request)
    {

//        dd($_FILES['img']);
//        $imgs = Input::file('img');
//        dd($imgs[0]);
//        dd($request->file('showImg'));
//        dd($request->file('img'));
//        dd($request->all());
        $good = new Good();
        $data = $request->all();
        $good->title = $data['title'];
        $good->cate_id = $data['cate_id'];
        $good->price = $data['price'];
        $good->status = 1;
        if($_FILES['showImg']['error']==0)
        {
            $good->showImg = self::uploadFile();

        }else{
            $good->showImg = config('app.upload_image_dir').'good.png';
        }
        if($_FILES['img']['error'][0]==0)
        {
            $good->img = self::uploadFiles();
        }

        $good->content = $data['content'];


        if($good->save()){
            return redirect('admin/sku/add?id='.$good->id)->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    public static function uploadFile()
    {
        $pic = $_FILES['showImg']['name'];
        $dir = config('app.upload_image_dir');
        $name = trim($dir.rand(1000000,9000000).time().'.'.pathinfo($pic,4),'.');
        Input::file('showImg')->move($dir,$name);
        return $name;
    }
    public static function uploadFiles()
    {

        $names = '';
        for ($i=0;$i<count($_FILES['img']['name']);$i++) {
            $pic = $_FILES['img']['name'][$i];
            $dir = config('app.upload_image_dir');
            $name = trim($dir.rand(1000000,9000000).time().'.'.pathinfo($pic,4),'.');
            $imgs = Input::file('img');
            $imgs[$i] -> move($dir,$name);
            $names .= $name.',';
        }

        return $names;
    }

   

    public function getEdit(Request $request)
    {
        $good = Good::where('id',$request->only('id'))->first();
        $cates = Cate::where('pid','0')->get();
        return view('admin.goods.update',['good'=>$good,'cates'=>$cates,'title'=>'修改详情']);
    }

    public function postUpdate(Request $request)
    {
        $data = $request->all();
        $good = Good::where('id',$request->only('id'))->first();

        //判断用户名
        if($good['title'] != $request->title) {

            if(Good::where('title','like', $request->title)->first()){

                return back()->with('error','文章标题已存在');

            }
        }

        $good -> title = $data['title'];
        $good -> cate_id = $data['cate_id'];
        $good -> price = $data['price'];
        $good -> status = $data['status'];
        $good->content = $data['content'];

        if($_FILES['showImg']['error']==0){
            self::updateFile();
            $good->img = self::uploadFile();
        }

        if($_FILES['img']['error'][0]==0)
        {
            $pics = Good::select('img')->where('id',$data['id'])->get();
            foreach (explode(',',$pics[0]->img) as $value)
            {
                if(file_exists($value)){
                    unlink($value);
                }
            }
            $good->img = self::uploadFiles();
        }
        $good -> save();

        return redirect('admin/good')->with('info','更新成功');
    }

    public static function updateFile()
    {
        $pic = Good::select('img')->where('id',Input::only('id'))->first();

        $dbpic = '.'.$pic['img'];

        $defaultpic = config('app.upload_image_dir').'good.png';

        if($dbpic != $defaultpic)
        {
            unlink(realpath($dbpic));
        }
    }

    public function getDelete(Request $request)
    {
        $id = $request->input('id');

        if(Good::where('id',$id)->first()->delete()){
            return back()->with('info','删除成功!');
        }else{
            return back()->with('error','删除失败!');
        }
    }

}
