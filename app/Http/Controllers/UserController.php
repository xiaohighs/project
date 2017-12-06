<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Mail;
use Illuminate\Http\Request;

class UserController extends Controller
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
            $users = DB::table('users')
                ->where('username','like','%'.$keywords.'%')
                ->paginate($num);
        }else{
            //列表显示
            $users = DB::table('users')->paginate($num);
        }


        //解析模板
        return view('admin.user.index', [
            'users'=>$users,
            'keywords' => $keywords,
            'num' => $num
            ]);
    }

    /**
     * 显示用户添加模板
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['username','password','email']);
        //加密密码
        $data['password'] = Hash::make($data['password']);
        //文件上传
        if($request->hasFile('profile')) {
            //获取文件的后缀名
            $suffix = $request->file('profile')->extension();
            //创建一个新的随机名称
            $name = uniqid('img_').'.'.$suffix;
            //文件夹路径
            $dir = './uploads/'.date('Y-m-d');
            //移动文件
            $request->file('profile')->move($dir, $name);
            //获取文件的路径
            $data['profile'] = trim($dir.'/'.$name,'.');
        }
        $data['status'] = 0;

        //将数据插入到数据库中
        if(DB::table('users')->insert($data)) {
            return redirect('/user')->with('msg','添加成功');
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
    }

    /**
     * 用户修改
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //读取当前用户的信息
        $user = DB::table('users')->where('id',$id)->first();

        return view('admin.user.edit', ['user'=>$user]);
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
        //获取数据
        $data = $request->only(['username','email']);
        //图片上传
        //文件上传
        if($request->hasFile('profile')) {
            //获取文件的后缀名
            $suffix = $request->file('profile')->extension();
            //创建一个新的随机名称
            $name = uniqid('img_').'.'.$suffix;
            //文件夹路径
            $dir = './uploads/'.date('Y-m-d');
            //移动文件
            $request->file('profile')->move($dir, $name);
            //获取文件的路径
            $data['profile'] = trim($dir.'/'.$name,'.');
        }

        //更新
        if(DB::table('users')->where('id',$id)->update($data)) {
            return redirect('/user')->with('msg','更新成功');
        }else{
            return back()->with('msg','更新失败');
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
        if(DB::table('users')->where('id', $id)->delete()) {
            return back()->with('msg','删除成功');
        }else{
            return back()->with('msg','删除失败!!');
        }
    }

    /**
     * 用户注册
     */
    public function signup()
    {
        return view('home.user.signup');
    }

    public function dosign(Request $request)
    {
        //检测验证码是否正确
        $code = $request->vcode;
        if(session('vcode') != $code) {
            return back()->with('msg','验证码错误');
        }

        //获取用户的信息
        $data = $request->only(['username','phone','email','password']);
        $data['password'] = Hash::make($data['password']);
        $data['verify'] = str_random(30);

        //插入数据
        if(DB::table('users')->insert($data)) {
            //发送一封激活邮件
            Mail::send('emails.send', ['data'=>$data], function ($message) use ($data) {
                //标题
                $message->subject('网站注册确认邮件');
                //接收者
                $message->to($data['email']);
            });

            return redirect('/')->with('msg','注册成功,一封激活邮件已经发送到您的邮箱,请确认激活!!');
        } else {
            return back()->with('msg','注册失败!!');
        }
    }

    /**
     * 用户的激活操作
     */
    public function confirm($id)
    {
        //根据id来查找数据库中的用户信息
        $user = DB::table('users')->where('verify',$id)->first();
        if(empty($user)) {
            return redirect('/')->with('msg','激活失败!!请重新激活');
        }
        //更新用户的状态
        $data = ['status'=>1];
        $res = DB::table('users')->where('id',$user->id)->update($data);

        if($res) {
            return redirect('/')->with('msg','激活成功');
        }else{
            return redirect('/')->with('msg','激活失败!!');
        }
    }
}
