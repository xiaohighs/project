<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num = $request->input('num', 10);
        $keywords = $request->input('keywords','');

        //关键字检索
        if($request->has('keywords')) {
            //列表显示
            $articles = DB::table('articles')
                ->where('title','like','%'.$keywords.'%')
                ->paginate($num);
        }else{
            //列表显示
            $articles = DB::table('articles')->paginate($num);
        }


        //解析模板
        return view('admin.article.index', [
            'articles'=>$articles,
            'keywords' => $keywords,
            'num' => $num
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取参数
        $data = $request->only(['title','content']);
        //针对图片处理
        if($request->hasFile('pic')) {
            //获取文件的后缀名
            $suffix = $request->file('pic')->extension();
            //创建一个新的随机名称
            $name = uniqid('img_').'.'.$suffix;
            //文件夹路径
            $dir = './uploads/'.date('Y-m-d');
            //移动文件
            $request->file('pic')->move($dir, $name);
            //获取文件的路径
            $data['pic'] = trim($dir.'/'.$name,'.');
        }

        //将数据插入到数据库中
        if(DB::table('articles')->insert($data)) {
            return redirect('/article')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //读取表中的文章信息
        $article = DB::table('articles')->where('id',$id)->first();
        //检测文章是否存在
        if(empty($article)) {
            abort(404);
        }

        //读取分类信息
        $cates = DB::table('cates')->get();

        //读取最近的文章
        $recents = DB::table('articles')->orderBy('id','desc')->take(5)->get();

        //解析模板
        return view('home.article.show', ['article'=>$article,'cates'=>$cates,'recents'=>$recents]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //读取当前用户的信息
        $article = DB::table('articles')->where('id',$id)->first();

        return view('admin.article.edit', ['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //获取参数
        $data = $request->only(['title','content']);
        //针对图片处理
        if($request->hasFile('pic')) {
            //获取文件的后缀名
            $suffix = $request->file('pic')->extension();
            //创建一个新的随机名称
            $name = uniqid('img_').'.'.$suffix;
            //文件夹路径
            $dir = './uploads/'.date('Y-m-d');
            //移动文件
            $request->file('pic')->move($dir, $name);
            //获取文件的路径
            $data['pic'] = trim($dir.'/'.$name,'.');
        }

        //将数据插入到数据库中
        if(DB::table('articles')->where('id',$id)->update($data)) {
            return redirect('/article')->with('msg','更新成功');
        }else{
            return back()->with('msg','更新失败!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //执行删除
        if(DB::table('articles')->where('id', $id)->delete()) {
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败!!');
        }
    }

    /**
     * 前台的文件列表页面
     */
    public function articleList()
    {
        //读取文章的列表
        $articles = DB::table('articles')->paginate(5);

        //读取分类信息
        $cates = DB::table('cates')->get();

        //读取最近的文章
        $recents = DB::table('articles')->orderBy('id','desc')->take(5)->get();

        //解析模板
        return view('home.article.index', compact('articles','cates','recents'));
    }
}
