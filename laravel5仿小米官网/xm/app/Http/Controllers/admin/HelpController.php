<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\HelpCate;
use App\HelpArticle;

class HelpController extends Controller
{
    //定义属性存储分类id集合
    private $cateGroup = [];
    /**
     * 显示帮助分类添加页面
     */
    public function getCateadd()
    {
        $cates = $this->getAllCates();
        return view('admin.help.cateadd',[
                'cates'=>$cates,
            ]);
    }
    /**
     * 添加帮助分类操作
     */
    public function postCateadd(Request $request)
    {
        //根据父类所属id写入path
       
        $info = new HelpCate;
        $pid = $request->input('pid');
        $info->name = $request->input('name');
        $info->pid = $pid;
        $info->show = $request->input('show');
        $info->path = $this->dealPath($pid);
        $info->status = $request->input('status');

        if($info->save()){
            return redirect('/admin/help/cate')->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }
    /**
     * 分类path数据写入处理
     */
    private function dealPath($pid)
    {
        $path = '';
        if($pid == 0){
            $path = '0';
        }else{
            $data = HelpCate::where('status',1)->find($pid);
            if(empty($data)){
                return back()->with('error','父类不存在,或被禁用');
            }
            $path = $data['path'].','.$data['id'];
        }
        return $path;
    }
    /**
     * 显示帮助栏目列表页
     */
    public function getCate(Request $request){
         $cates = \DB::table('help_cates as a')
                ->select(\DB::raw('a.*,b.name as names,concat(a.path,",",a.id,",") as paths'))
                ->leftJoin('help_cates as b','a.pid','=','b.id')
                ->orderBy('paths')
                // ->where('a.status',1)
                ->where(function($query)use($request){
                    if(!empty($request->input('keywords'))){
                        $query->where('a.name','like','%'.$request->input('keywords').'%');
                    }
                })
                ->paginate($request->input('num',25));
        foreach($cates as $k=>$v)
        {
            $num = substr_count($v->path,',');
            $str = '';
            if($num>0){
                $str = str_repeat('　　',$num);
            }
            $str .= '<i class="icon-minus j-slide" style="width:16px;height: 16px;line-height:16px;text-align: center;border-radius:3px;color:#fff;background: #06A798;cursor:pointer;"></i><a href="/admin/help/article?id='.$v->id.'" style="color:#333">';
            $v->name = $str.$v->name.'</a>';
        }

        return view('admin.help.cate',[
                'request'=>$request,
                'cates'=>$cates->toArray(),
                'pages'=>$cates->appends($request->all())->render(),
            ]);
    }
    /**
     * ajax更新 cate status
     */
    public function getAjaxcatestatus(Request $request)
    {
        $nav = HelpCate::find($request->input('id'));
        $nav->status = $request->input('status');
        if($nav->save()){
            echo 0;die;
        }else{
            echo 1;die;
        }
    }
        /**
     * ajax更新 cate show
     */
    public function getAjaxcateshow(Request $request)
    {
        $nav = HelpCate::find($request->input('id'));
        $nav->show = $request->input('status');
        if($nav->save()){
            echo 0;die;
        }else{
            echo 1;die;
        }
    }
    /**
     * 显示栏目分类编辑页面
     */
    public function getCateedit(Request $request)
    {
        //通过id查找数据信息
        $info = HelpCate::find($request->input('id'));
        //
        $cates = $this->getAllCates();
      
        return view('admin.help.cateedit',[
                'info'=>$info,
                'cates'=>$cates,
            ]);
    }
    /**
     * 编辑栏目分类
     */
    public function postCateedit(Request $request)
    {
        //查询当前分类的信息
        $info = HelpCate::findOrFail($request->input('id'));
        

        //开启事务处理
        \DB::beginTransaction();
        //获取当前分类的path 
        $path = $info -> path.','.$info->id;
        //获取当前分类的子分类
        $data = HelpCate::where( 'path','like',$path.'%')->get();
        
        //获取要移动至的分类的信息
        $moveCate = HelpCate::findOrFail($request->input('pid'));
        $movepath = $moveCate->path.','.$moveCate->id.','.$info->id;
    
        //遍历子分类 更改子类path
        foreach($data as $k=>&$v){
            $temp = HelpCate::findOrFail($v->id);
            $temp->path = str_replace($path,$movepath,$v->path);
            if(!$temp->save()){
                \DB::rollback();
                return back()->with('error','修改失败');
            }
        }

        $info->name = $request->input('name');
        $info->pid = $request->input('pid');
        $info->show = $request->input('show');
        $info->status = $request->input('status');
        $info->path = $this->dealPath($request->input('pid'));
        if($info->save()){
            \DB::commit();
            //查找他的所有子类
            return redirect('/admin/help/cate')->with('info','修改成功');
        }else{
            \DB::rollback();
            return back()->with('error','修改失败');
        }
      
    }
    /**
     * 删除栏目分类
     */
    public function getCatedel(Request $request)
    {
        //通过id查找数据信息
        $info = HelpCate::find($request->input('id'));
        //
        if($info->delete()){
            return back()->with('info','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
    /**
     * 优化分类的层级显示
     */
    private static function getAllCates()
    {
        //查询数据库
        $cates = \DB::table('help_cates as a')
                ->select(\DB::raw('a.*,b.name as names,concat(a.path,",",a.id,",") as paths'))
                ->leftJoin('help_cates as b','a.pid','=','b.id')
                ->orderBy('paths')
                ->where('a.status',1)
                ->get();
        foreach($cates as $k=>$v){
            $num = substr_count($v->path,',');
            if($num==1){
                $str = '|----';
            }else if($num>1){
                $str = str_repeat('|　　',$num);
                $str .= '|----';
            }else{
                $str = '';
            }
            
            $v->name = $str.$v->name;
        }
        return $cates;
    }

    /**
     * 显示分类文章添加页面
     */
    public function getAdd(Request $request)
    {
        $cates = $this->getAllCates();
        return view('admin.help.add',[
                'cates'=>$cates,
                'request'=>$request,
            ]);
    }
    /**
     * 添加分类文章操作
     */
    public function postAdd(Request $request)
    {

        $info = new HelpArticle;
        $info->title = $request->input('name');
        $info->help_cate_id = $request->input('pid');
        $info->content = $request->input('content');
        $info->status = $request->input('status');
        //将数据插入到数据库中
        if($info->save()){
            return redirect('admin/help/article?id='.$request->input('pid'))->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }
    /**
     * 显示帮助栏目文章列表页
     */
    public function getArticle(Request $request)
    {
        $id = $request->input('id');
        if($id&&!is_numeric($id)){
            abort(404);
        }
        //获取数据库中的文章 通过分类id获取

        $articles = $this->gainArticle($id,$request);

        $pagesize = $request->input('num',10);
        $total = count($articles);
        $pages = ceil($total/$request->input('num',10));
        $page=$request->input('page',1);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($articles, count($articles),$request->input('num',10));
        // $paginator = $paginator->setPath(route('admin.help.article'));
        //设置分页href路径
        $paginator=$paginator->setPath('/admin/help/article');
        //数组截数据 显示
        $pageout=array_slice($articles, ($page-1)*$pagesize,$pagesize);

        return view('admin.help.article',[
                'request'=>$request,
                'articles'=>$pageout,
                'pages'=>$paginator->appends($request->all())->render(),
            ]);
    }
    /**
     * 获取帮助栏目分类下所有的文章(包括子类)
     */
    private function gainArticle($cate_id,$request=null)
    {
        $this->gainCateById($cate_id);
        //定义变量存储查询到的信息
        $data = [];
        //遍历所有的类id查询对应的文章信息
        foreach($this->cateGroup as $k=>$v){

            $temp = HelpArticle::where('help_cate_id',$v)
            ->where(function($query)use($request){

                if($request&&!empty($request->input('keywords'))){
                    $query->where('title','like','%'.$request->input('keywords').'%');
                }
            })
            ->get();
            if(!empty($temp[0])){
                //将数据存储到$data中去
                //$data = array_merge($data,$temp);
                foreach($temp as $k1=>$v1){
                    $data[] = $v1;
                }
            }
            

        }

        return $data;

    }
    /**
     * 获取帮助栏目下某个分类下的所有子分类id 
     * !!-------------- 但没有包含该分类
     *  解决方法见279 else之后的内容
     */
    public function gainCateById($cate_id)
    {
        //处理没有传参(id)的情况
        if(empty($cate_id)){
            $cate_id = 0;
        }else{
            //包含自己的分类id 单不包含 顶级分类0 因为 绝对没有文章分类为0        
            empty($this->cateGroup)?$this->cateGroup[]= (int)($cate_id) : '';
        }
        //获取他的所有一级子类
        $helpCate = HelpCate::where('pid',$cate_id)->get();
        
        foreach($helpCate as $k=>$v){
            $this->cateGroup[] = $v->id;
            $this->gainCateById($v->id);
        }

        return $this->cateGroup;

    }
    /**
     * ajax 更改显示状态
     */
    public function getAjaxstatus(Request $request)
    {
        $nav = HelpArticle::find($request->input('id'));
        $nav->status = $request->input('status');
        if($nav->save()){
            echo 0;die;
        }else{
            echo 1;die;
        }
    }
    /**
     * 显示栏目文章修改
     */
    public function getArtedit(Request $request)
    {
        $cates = $this->getAllCates();
        $article = HelpArticle::findOrFail($request->input('id'));
        return view('admin.help.artedit',[
            'cates'=>$cates,
            'article'=>$article,
            ]);
    }
    /**
     * 栏目文章修改页面
     */
    public function postArtedit(Request $request)
    {
        $info = HelpArticle::findOrFail($request->input('id'));
        $info->title = $request->input('name');
        $info->help_cate_id = $request->input('pid');
        $info->content = $request->input('content');
        $info->status = $request->input('status');
        //将数据插入到数据库中
        if($info->save()){
            return redirect('admin/help/article?id='.$request->input('pid'))->with('info','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
    /**
     * 删除栏目文章操作
     */
    public function getArtdel(Request $request)
    {
        //通过id查找数据信息
        $info = HelpArticle::find($request->input('id'));
        //
        if($info->delete()){
            return back()->with('info','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
    /**
     * 插入数据
     */
    public function getData()
    {
        $str = file_get_contents('./data/ad.html');
        // preg_match_all('/<dt>(.*)<\/dt>.*<a.*>(.*)<\/a>/isU',$str,$data1);
        preg_match_all('/<dt>(.*)<\/dt>/isU',$str,$data1);
        // preg_match_all('/<a.*>(.*)<\/a>/isU',$str,$data2);
        // preg_match_all('/<(dt|a).*>(.*)<\//isU',$str,$data1);
        foreach($data1[1] as $k=>$v){
            // if($data1[1][$k] == 'dt'){
                $res = new HelpCate;
                $res->status = 1;
                $res->name = $v;
                $res->show = 1;
                $res->pid = 1;
                $res->path = $this->dealPath(1);
                if($res->save()){
                    $pid = $res->id;
                }
            // }
            // if($data1[1][$k]=='a'){
            //     $res = new HelpCate;
            //     $res->status = 1;
            //     $res->name = $v;
            //     $res->show = 1;
            //     $res->path = $this->dealPath($pid);
            //     $res->pid = $pid;
            //     $res->save();
            // }
        }
    }
    /**
     * 插入文章数据
     */
    public function getArticleData()
    {
        $curl = new \Curl\Curl;
        $str = file_get_contents('./data/ad.html');
        // preg_match_all('/<dt>(.*)<\/dt>.*<a.*>(.*)<\/a>/isU',$str,$data);
        preg_match_all('/<(dt|a)(.*)>(.*)<\//isU',$str,$data);
        
        foreach($data[1] as $k=>$v){
            if($data[1][$k] == 'dt'){
               
                $res = HelpCate::where('name',$data[3][$k])->first();
                //查找分类Id
                $pid = $res->id;
                
            }

            if($data[1][$k]=='a'){
                //获取链接地址
                preg_match('/href="(.*)"/isU',$data[2][$k],$link);
                $curl->get('http:'.$link[1]);

                preg_match('/<h2>(.*)<\/h2>.*class="service-right-section">(.*)<\/div>/isU',$curl->response,$temp);
                if(!empty($temp)){
                    $at = new HelpArticle;
                    $at->title = $temp[1];
                    $at->help_cate_id = $pid;
                    $at->status = 1;
                    $at->content = trim($temp[2]).'</div>';
                    $at->save();
                }
            }
        }
    }
}
