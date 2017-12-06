<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
	/**
	 * 网站后台首页
	 */
    public function index()
    {
    	return view('admin.index');
    }
}
