<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Navigation;
use App\Sku;

class IndexController extends Controller
{
    public function getNavadd()
    {
        $skus = $this::getAllSku();
        return view('admin.index.navadd',[
            'skus'=>$skus,
        ]);
    }
    /**
     * 导航栏目插入操作
     */
    public function postNavadd(Request $request)
    {

        $nav = new Navigation; 
        $nav->nav_name = $request->input('nav_name');
        $nav->sku_id_group = $request->input('sku_id_group');
        $nav->status = 1;
        if($nav->save()){
            return redirect('/admin/indexPage/navlist')->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }
    /**
     * 显示栏目列表页
     */
    public function getNavlist(Request $request)
    {
        $navs = Navigation::get();

        return view('admin.index.navlist',[
                'navs'=>$navs,
                'request'=>$request,
            ]);
    }
    /**
     * ajax 更新栏目状态
     */
    public function getAjaxnavupdate(Request $request)
    {
        $nav = Navigation::find($request->input('id'));
        $nav->status = $request->input('status');
        if($nav->save()){
            echo 0;die;
        }else{
            echo 1;die;
        }
    }
    /**
     * 显示导航栏目编辑页面
     */
    public function getNavedit(Request $request){
        $nav = Navigation::find($request->input('id'));
        $sku_id_group = explode(',',$nav->sku_id_group);
        $data = $this->skuData($sku_id_group);

        return view('admin.index.navedit',[
            'skus'=>$this::getAllSku(),
            'nav'=>$nav,
            'data'=>$data,
            ]);
    }
    /**
     * 获取导航栏目sku数据
     */
    private function skuData($sku_id_group)
    {
        $data = [];
        foreach ($sku_id_group as $key => $value) {
            $data[] = Sku::select('id','title','price','img','good_id')->where('status',1)->find($value);
        }
        return $data;
    }
    /**
     * 执行导航栏目编辑操作
     */
    public function postNavedit(Request $request){
        $nav = Navigation::find($request->input('id'));
        $nav->nav_name = $request->input('nav_name');
        $nav->status = $request->input('status');
        $nav->sku_id_group = trim($request->input('sku_id_group'),',');
  
        if(!empty($request->input('nav_url'))){
            $nav->nav_url = $request->input('nav_url');
        }
        if($nav->save()){
            return redirect('/admin/indexPage/navlist')->with('info','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
        
    }
    /**
     * 导航栏目删除操作
     */
    public function getNavdel(Request $request)
    {
        $nav = Navigation::findOrFail($request->input('id'));

        if($nav->delete()){
            return back()->with('info','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
    /**
     * 写入导航栏目到indexNav.js文件中
     */
    public function getAjaxcreate()
    {
        $navs = Navigation::where('status',1)->get();
        $data = [];
        foreach($navs as $k=>$v)
        {
            $temp = [];
            $temp['title'] = $v->nav_name;
            $info = $this->skuData( explode(',',$v->sku_id_group) );
            $temp['info'] = $this->dealShuData($info);
            $data[] = $temp;
        }
        $str = json_encode($data);
        $str = 'var navData = '.$str;

        if(!file_put_contents('./data/indexNav.js',$str)){
            echo 0;
            die;
        }

        return $str;
    }
    /**
     * 处理sku数据
     */
    private function dealShuData( $info )
    {

        $data = [];
        if(empty($info)){
            return null;
        }
        foreach ($info as $key => $value) {
            $temp = [];
            $temp['title'] = $value->title;
            $temp['price'] = $value->price;
            $temp['img'] = $value->img;
            $temp['good_id'] = $value->good_id;
            $data[]=$temp;
        }
        return $data;
    }

    public static function getAllSku()
    {
        $skus = DB::table('skus as a')->select('a.id','a.title','a.good_id','a.attr','a.price','a.img','b.title as bt')
            ->where('b.status',1)
            ->where('a.status',1)
            ->leftJoin('goods as b','a.good_id','=','b.id')
            ->orderBy('a.price','desc')
            ->get();
        return $skus;
    }

    /**
     * 显示明星单品添加页
     */
    public function getStaradd(Request $request)
    {
        if(file_exists('./data/stargoods.json')){
            $data = file_get_contents('./data/stargoods.json');

            $data = json_decode($data);
            if(!empty($data)){
                $str = '';
                foreach ($data as $key => $value) {
                    $str .= $value->id.',';
                }
                $str =trim($str,',');
                return view('admin.index.staradd',[
                        'data'=>$data,
                        'str'=>$str,
                    ]);
            }
        }
        return view('admin.index.staradd');
    }
    /**
     * 处理明星产品添加页
     */
    public function postStaradd(Request $request)
    {
        $info = trim($request->input('name'));
        $info = explode(',',$info);
        $info = $this->unqiue($info);
        $data = [];
        foreach($info as $k=>$v)
        {
            $temp = \DB::table('goods')->select('title','id','price','sub_title','showImg')->where('id',$v)->first();
            if(empty($temp)){
                return back()->with('error',$v.'该id对应的商品信息不存在');
            }
            $data[] = $temp;
        }

        if(file_put_contents('./data/stargoods.json',json_encode($data))){
            return back()->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }

    }

    /**
     * 数组去重
     */
    private function unqiue($arr)
    {
        $temp = [];
        if(!empty($arr)){
            foreach($arr as $k=>$v)
            {
                if(in_array($v,$temp)){
                    unset($arr[$k]);
                    continue;
                }
                $temp[] = $v;

            }
            
        }
        return $arr;
    }

    /**
     * 显示分类导航后台生成页面
     */
    public function getSort()
    {
        return view('admin.index.sort');
    }
    /**
     * 获取分类导航信息
     */
    public function getSortnav()
    {
        $cates = DB::table('cates')->where('status',1)->get();

        //定义变量存储数据
        $data = [];
        foreach($cates as $key=>$val){
            if($val->pid == 0){
                $temp = [];

                $temp['data']['title'] = $val->name;
                $temp['data']['id'] = $val->id;

                $child = DB::table('cates')->select('id','img','name as title')->where('pid',$val->id)->where('status',1)->get();

                $temp['child'] = [];
                foreach($child as $k => $v){
                    $temp['child'][] = $v;
                }
                $data[] = $temp;
            }
        }
        
        $dataStr = json_encode($data);
        $dataStr = 'var cate = '.$dataStr.';';
        if(file_put_contents('./data/indexData.js',$dataStr)){
            echo 1;die;
        }else{
            echo 0;die;
        }
    }
}
