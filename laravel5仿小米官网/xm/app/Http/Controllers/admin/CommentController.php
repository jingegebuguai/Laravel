<?php

namespace App\Http\Controllers\admin;

use App\Comment;
use App\Good;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    public function getIndex()
    {
        
        $Comments = Comment::all();
        return view('admin.Comment.index',['comments'=>$Comments,'title'=>'回复列表']);
    }
    public function getAdd()
    {
        $Goods = Good::all();
        $Comments = Comment::where('pid',0)->get();
        return view('admin.Comment.add',['title'=>'添加用户','goods'=>$Goods,'comments'=>$Comments]);
    }

//    public function postInsert(Requests\CommentInsertRequest $request)
    public function postInsert(Request $request)
    {
        $Comment = new Comment();
        $data = $request->all();
        $Comment->user_id = $data['user_id'];
        $Comment->Good_id = $data['Good_id'];
        $Comment->star = $data['star'];
        $Comment->pid = $data['pid'];
        if($data['pid']==0){
            $Comment->path = 0;
        }else{
            $pComment = Comment::find($data['pid']);
            $Comment->path = $pComment->pid.','.$pComment->id;
        }
        $Comment->status = 1;
        if($request->hasFile('pic'))
        {
            $Comment->img = self::uploadFile();

        }else{
            $Comment->img = config('app.upload_image_dir').'Good.png';
        }
        $Comment->content = $data['content'];


        if($Comment->save()){
            return redirect('admin/comment/add')->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    public static function uploadFile()
    {
        $pic = $_FILES['pic']['name'];
        $dir = config('app.upload_image_dir');
        $name = trim($dir.rand(1000000,9000000).time().'.'.pathinfo($pic,4),'.');
        Input::file('pic')->move($dir,'/'.$name);
        return $name;
    }

    public function getEdit(Request $request)
    {
        $Comment = Comment::find($request->id);
        $Goods = Good::all();
        $Comments = Comment::where('pid',0)->get();
        return view('admin.comment.update',['comment'=>$Comment,'comments'=>$Comments,'goods'=>$Goods,'title'=>'修改详情']);
    }

    public function postUpdate(Request $request)
    {
        $data = $request->all();
        $Comment = Comment::where('id',$request->only('id'))->first();

        //判断用户名
        if($Comment['title'] != $request->title) {

            if(Comment::where('title','like', $request->title)->first()){

                return back()->with('error','文章标题已存在');

            }
        }

        $Comment -> user_id = $data['user_id'];
        $Comment -> Good_id = $data['Good_id'];
        $Comment -> star = $data['star'];
        $Comment -> pid = $data['pid'];
        $Comment -> status = $data['status'];
        $Comment -> content = $data['content'];
        if($request->hasFile('pic')){
            self::updateFile();
            $Comment->img = self::uploadFile();
        }

        $Comment -> save();
        
        return redirect('/admin/Comment')->with('info','更新成功');
    }

    public static function updateFile()
    {
        $pic = Comment::select('img')->where('id',Input::only('id'))->first();
        
        $dbpic = $pic['img'];

        $defaultpic = config('app.upload_image_dir').'comment.png';

        if($dbpic != $defaultpic)
        {
            if(file_exists($dbpic)){
                unlink(realpath($dbpic));
            }
        }
    }


    public function getDelete(Request $request)
    {
        $id = $request->input('id');
        
        if(Comment::where('id',$id)->first()->delete()){
            return back()->with('info','删除成功!');
        }else{
            return back()->with('error','删除失败!');
        }
    }
}
