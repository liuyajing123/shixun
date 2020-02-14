<?php

namespace App\Http\Controllers\mianshi;

use App\Http\Controllers\Controller;
use common\view;
use Illuminate\Http\Request;
use DB;
class testController extends Controller
{
    public function add()
    {
//        echo 1234;
        return view('mianshi/add');
    }
    public function do_add(request $request)
    {
        $data=$request->all();
//         dd($data);
        $path = $request->file('pic')->store('mianshi');
//         dd($path);
        $img=asset('storage'.'/'.$path);
        // dd($img);
        $res=DB::table('company')->insert([
            'name'=>$data['name'],
            'address'=>$data['address'],
            'pic'=>$img,
            'time'=>$data['time']
        ]);
        if($res){
            echo "<script>alert('添加成功');location.href='/mianshi/index';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/mianshi/add';</script>";
        }
    }
    public function index(Request $request)
    {
        $data=$request->all();
        $res = DB::table('company')->get();
        return view('mianshi/index',['res'=>$res]);
    }
}
