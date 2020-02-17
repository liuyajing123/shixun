<?php

namespace App\Http\Controllers\mianshi;

use App\Http\Controllers\Controller;
use common\view;
use Illuminate\Http\Request;
use DB;
class testController extends Controller
{
//    添加
    public function add()
    {
//        echo 1234;
        return view('mianshi/add');
    }

    public function do_add(request $request)
    {
        $data = $request->all();
//         dd($data);
        $path = $request->file('pic')->store('mianshi');
//         dd($path);
        $img = asset('storage' . '/' . $path);
        // dd($img);
        $res = DB::table('company')->insert([
            'name' => $data['name'],
            'address' => $data['address'],
            'pic' => $img,
            'time' => $data['time']
        ]);
        if ($res) {
            echo "<script>alert('添加成功');location.href='/mianshi/index';</script>";
        } else {
            echo "<script>alert('添加失败');location.href='/mianshi/add';</script>";
        }
    }

//    面试列表
    public function index(Request $request)
    {
        $data = $request->all();
        $res = DB::table('company')->get();
        return view('mianshi/index', ['res' => $res]);
    }

//    后台登录
    public function admin()
    {
//        echo 123435;
        return view('mianshi/admin');
    }
    public function do_admin(Request $request)
    {
//        echo 12313123;
        $name = $request->input('name');
//        dd($name);
        $pwd = $request->input('password');
//        dd($pwd);
        $res = DB::table('admin')->where(['name' => $name, 'password' => $pwd])->first();
//        dd($res);
        if ($res) {
            echo "<script>alert('登录成功');location.href='/mianshi/admin_add';</script>";
        } else {
            echo "<script>alert('登录失败');location.href='/mianshi/admin';</script>";
        }
    }

//   后台添加前台用户
    public function admin_add()
    {
//        echo 1231213;
        return view('mianshi/admin_add');
    }
    public function do_admin_add(Request $request)
    {
//        echo 123123;
        $name = $request->input('name');
//        dd($name);
        $pwd = $request->input('password');
//        dd($pwd);
        $res = DB::table('index')->insert([
            'name'=>$name,
            'password'=>$pwd
        ]);
        if ($res) {
            echo "<script>alert('添加成功');location.href='/mianshi/login';</script>";
        } else {
            echo "<script>alert('添加失败');location.href='/mianshi/admin_add';</script>";
        }
    }
//    后台添加前台用户列表
    public function admin_list(Request $request)
    {
        $data = $request->all();
        $res = DB::table('index')->get();
        return view('mianshi/admin_list', ['res' => $res]);
    }
//    前台登录
    public function login()
    {
        return view('mianshi/login');
    }
    public function do_login(Request $request)
    {
        $name = $request->input('name');
        $pwd = $request->input('password');
        $res = DB::table('index')->where(['name'=>$name,'password'=>$pwd])->first();
        if ($res) {
            echo "<script>alert('登录成功');location.href='/mianshi/add';</script>";
        } else {
            echo "<script>alert('登录失败');location.href='/mianshi/login';</script>";
        }
    }
}
