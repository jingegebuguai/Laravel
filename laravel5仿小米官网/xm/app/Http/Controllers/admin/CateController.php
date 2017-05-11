<?php

namespace App\Http\Controllers\admin;

use App\Cate;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class CateController extends Controller
{
    public function getIndex()
    {
        $cates = Cate::orderBy('path')->get();

        $data =[];
        foreach ($cates as $key => $value) {
            $data[$value->id] = $value->name;
        }
        foreach ($cates as $key => $cate) {
            $path = $cate->path;
            $count = count(explode(',',$path))-1;
            $prefix = str_repeat('|------',$count);
            $cate -> name = $prefix.$cate -> name;
            $cate -> path = $cate -> path.','.$cate -> id;
            $pid = $cate -> pid;
            if($pid == 0){
                $cate -> pid = '顶级分类';
            }else{
                $cate -> pid = $data[$pid];
            }
        }
        return view('admin.cate.index',['cates'=>$cates,'title'=>'分类列表']);
    }
    
    public function getAdd()
    {
        $cates = Cate::all();
        
        return view('admin.cate.add',['cates'=>$cates]);
    }

    public function postInsert(Requests\CateInsertRequest $request)
    {
        $cate = new Cate();
        $data = $request->only('name','pid','status');
        $cate->name = $data['name'];
        $id = $data['pid'];
        $cate->pid = $id;
        $path = Cate::where('id',$id)->first();
        $path = $path->path.','.$id;
        $cate->path = $path;
        $cate->status = $data['status'];
        if($cate->save()){
            return redirect('admin/cate')->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }



    public function getEdit(Request $request)
    {
        $cate = Cate::where('id',$request->only('id'))->first();
        $cates = Cate::all();
        return view('admin.cate.update',['cate'=>$cate,'title'=>'添加用户','cates'=>$cates]);
    }

    public function postUpdate(Requests\CateUpdateRequest $request)
    {



        $cate = Cate::where('id',$request->only('id'))->first();

        //判断用户名
        if($cate['name'] != $request->name) {

            if(Cate::where('name','like', $request->name)->first()){

                return back()->with('error','类名已存在');

            }
        }
        $data = $request->only('name','pid','status');
        $cate -> name = $data['name'];
        $id = $data['pid'];
        $cate -> pid = $id;
        $path = Cate::where('id',$id)->first();
        $path = $path->path.','.$id;
        $cate -> path = $path;
        $cate->status = $data['status'];
        $cate -> save();
        return redirect('admin/cate')->with('info','更新成功');
    }

    public function getDelete(Request $request)
    {
        $id = $request->input('id');
        if(Cate::where('id',$id)->first()->delete()){
            return back()->with('info','删除成功!');
        }else{
            return back()->with('error','删除失败!');
        }
    }

    /*
     * $arr = [
            '男装'=>[
                '衬衫'=>['韩版衬衫'=>[], '秦版衬衫' => [],],
                '西裤'=>[],
                '平角内裤'=>[],
            ],
            '女装'=>[
                '裙子'=>['连衣裙'=>[],'拖地长裙'=>[],'超短裙'=>[]],
                '鞋'=>['凉鞋'=>[],'高跟鞋'=>[],'一字带'=>[]]
            ],
            '童装'=>[],
            '老人装'=>[]
        ];
     *
     * */
    
    public  static function getCate($pid)
    {
        $array = [];
        $cates = Cate::where('pid',$pid)->get();

        foreach ($cates as $key => $cate) {
            $array[$cate->name] = self::getCate($cate->id);
        }
        return($array);

    }
    public function getTest()
    {
        dd(self::getCate(0));
    }
    
    


}
