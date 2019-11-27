<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Tool\wechat;
use GuzzleHttp\Client;
class adminController extends Controller
{
    public $wecaht;
    public function __construct(wechat $wechat)
    {
        $this->wechat=$wechat;
    }
    //    获取token
    public function access_token()
    {
        return $this->wechat->get_access_token();
    }
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
//  登录执行
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
        $codename = $request->input('codename');
        //        判断验证码是否为空
        if(empty($code)){
            echo "<script>alert('验证码不能为空');location.href='/admin/login';</script>";die;
        }
        //判断验证码是否正确
        if($code != $codename)
        {
            echo "<script>alert('验证码不正确');location.href='/admin/login';</script>";die;
        }
//        判断用户名是否为空
        if(empty($name)){
            echo "<script>alert('用户名不能为空');location.href='/admin/login';</script>";die;
        }
//        判断密码是否为空
        if(empty($password)){
            echo "<script>alert('密码不能为空');location.href='/admin/login';</script>";die;
        }
        $res=DB::table('login')->where(['name'=>"$name",'password'=>"$password"])->first();
       if($res){
           echo "<script>alert('登陆成功！');location.href='/admin/admin';</script>";die;
       }else{
           echo "<script>alert('登陆失败！');location.href='/admin/login';</script>";die;
       }
    }
    /*
     * 分类增删改查
     */
//    添加视图
    public function cate_add()
    {
        return view('cate/cate_add');
    }
//    添加执行
    public function do_cate_add(Request $request)
    {
//        echo 111;
        $name = $request->input('cate_name');
//        dd($name);
        $res = DB::table('cate')->insert([
            'cate_name'=>$name,
        ]);
        if($res){
            echo "<script>alert('添加成功！');location.href='/admin/cate_list';</script>";die;
        }else{
            echo "<script>alert('添加失败！');location.href='/admin/cate_add';</script>";die;
        }
    }
//    分类列表
    public function cate_list()
    {
        $res = DB::table('cate')->get()->toArray();
//        dd($res);
        return view('cate/cate_list',['res'=>$res]);
    }
//    分类删除
    public function delete_cate($id)
    {
//        dd($id);
        $res = DB::table('cate')->where(['id' => $id])->delete();
        if($res){
            echo "<script>alert('删除成功！');location.href='/admin/cate_list';</script>";die;
        }else{
            echo "<script>alert('删除失败！');location.href='/admin/cate_list';</script>";die;
        }
    }
//    分类修改
    public function update_cate($id)
    {
        $data = DB::table("cate")->where('id',$id)->first();
//        dd($data);
        return view("cate/update_cate",['data'=>$data]);
    }
//    分类修改执行
    public function update(Request $request)
    {
        $name = $request->input('cate_name');
//        dd($name);
        $id=$request->get('id');
        $res=DB::table("cate")->where('id',$id)->update([
            'cate_name'=>$name,
        ]);
        if($res){
            echo "<script>alert('修改成功！');location.href='/admin/cate_list';</script>";die;
        }else{
            echo "<script>alert('修改失败！');location.href='/admin/cate_list';</script>";die;
        }
    }

    /*
     * 上传素材到公众号
     */
    public function upload_video()
    {
        return view('upload/upload_video');
    }
    public function do_upload(Request $request)
    {
        $upload_type = $request['up_type'];
        $re = '';
        if($request->hasFile('image')){
            //图片类型
            $re = $this->wechat->upload_source($upload_type,'image');
        }elseif($request->hasFile('voice')){
            //音频类型
            //保存文件
            $re = $this->wechat->upload_source($upload_type,'voice');
        }elseif($request->hasFile('video')){
            //视频
            //保存文件
            $re = $this->wechat->upload_source($upload_type,'video','视频标题','视频描述');
        }elseif($request->hasFile('thumb')){
            //缩略图 和图片一样 所以没处理
            $path = $request->file('thumb')->store('wechat/thumb');
        }
        echo $re;
        dd();
    }
    /*
     * 公众号菜单
     */

}
