<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //读取分类的信息
        $cates = DB::select("select id,name,pid,concat(path,'_',id) as paths from cates order by paths");

        //修改分类的名称  thinkphp  =>    |-----thinkphp  trim  substr  strstr  strrchr strtoupper strtolower explode implode  str_shuffle
        foreach ($cates as $key => &$value) {
            //根据path来进行数据分隔 判断层级数   1-1-1-1
            $count = count(explode('_', $value->paths))-2;

            $value->name = str_repeat('|-----', $count).$value->name;
        }

        //解析模板
        return view('admin.cate.index', ['cates'=>$cates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取分类信息
        $cates = DB::table('cates')->get();
        //分配变量 解析模板
        return view('admin.cate.create', ['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取参数数据
        $data = $request->except(['_token']);

        //判断是否为顶级分类
        if($data['pid'] == 0) {
            $data['path'] = '0';
        }else{
            //读取父级分类的信息
            $p = DB::table('cates')->where('id', $data['pid'])->first();
            $data['path'] = $p->path.'_'.$p->id;
        }

        //将数据插入到数据库中
        if(DB::table('cates')->insert($data)) {
            return redirect('/cate')->with('msg','添加成功');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取当前的分类信息
        $cate = DB::table('cates')->where('id',$id)->first();
        // 拼接path
        $path = $cate->path .'_'.$cate->id;// 0_1_3
        //删除子分类
        $res = DB::table('cates')->where('path','like',$path.'%')->delete();
        //删除自己
        if(DB::table('cates')->where('id',$id)->delete()) {
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败!!!');
        }

    }
}
