<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
class adminController extends Controller
{
    /*
     * 后台首页
     */
    public function admin()
    {
        return view('admin/object');
    }
    /*
     * 后台登录
     */
    public function login()
    {
        return view('login/login');
    }
    /*
     * 登录执行
     */
    public function do_login(Request $request)
    {
//        接收用户名
        $name = $request->input('name');
//        dd($name);
//        接收密码
        $password = $request->input('password');
//        dd($password);
//       接收验证码
        $code = $request->input('code');
//        dd($code);
//        判断用户名是否为空
        if(empty($name)){
            echo "<script>alert('用户名不能为空');location.href='/admin/login';</script>";die;
        }
//        判断密码是否为空
        if(empty($password)){
            echo "<script>alert('密码不能为空');location.href='/admin/login';</script>";die;
        }
//        判断验证码是否为空
        if(empty($code)){
            echo "<script>alert('验证码不能为空');location.href='/admin/login';</script>";die;
        }
        $res=DB::table('login')->insert([
            'name'=>$name,
            'password'=>$password,
            'code'=>$code
        ]);
       if($res){
           echo "<script>alert('登陆成功！');location.href='/admin/admin';</script>";die;
       }else{
           echo "<script>alert('登陆失败！');location.href='/admin/login';</script>";die;
       }
    }
}
