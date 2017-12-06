<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class LoginController extends Controller
{
    //
    public function login()
    {
    	return view('admin.login');
    }

    public function dologin(Request $request)
    {
    	//提取参数
    	$data = $request->except(['_token']);

    	//检测数据是否正确 根据用户名来查找用户信息
    	$user = DB::table('users')->where('username', $data['username'])->first();

    	//判断 没有这个用户
    	if(empty($user)) {
    		return back()->with('msg','登陆失败!!');
    	}
    	
    	//校验密码
    	if (Hash::check($data['password'], $user->password)) {
		    // 密码对比...写入session信息
		    session(['id'=>$user->id]);
		    session(['username'=>$user->username]);

		    //登陆成功
		    return redirect('/admin')->with('msg','登陆成功');
		    
		}
		return back()->with('msg','登陆失败!!');
		//

    }
}
