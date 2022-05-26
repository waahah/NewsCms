<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Adv;
use App\Advcontent;

class AdvController extends Controller
{
    public function add($id = 0){
        $data = [];
        if($id > 0){
            $data = Adv::find($id);
        }
        return view('admin.adv.add', ['data' => $data]);
    }

    public function save(Request $request){
        $data = $request->all();

        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.require'=>'名称不能为空'
        ]);
        if(isset($data['id'])){
            $id = $data['id'];
            unset($data['id']);
            unset($data['_token']);
            $res = Adv::where('id',$id)->update($data);
            $type = $res ? "message" : "tip";
            $message = $res ? "修改成功" : "修改失败";
            return redirect('adv')->with($type, $message);
        }

        $re = Adv::create($data);
        if($re){
            return redirect('adv')->with('message','添加成功');
        }else{
            return redirect('adv/add')->with('tip','添加失败');
        }
    }

    public function index(){
        $adv = Adv::all();
        return view('admin.adv.index', ['adv' => $adv]);
    }

    public function delete($id){

        if (!$content = Adv::find($id)) {
            return response()->json(['code' => 0, 'msg' => '删除失败，记录不存在。' ]);
        }
        if(Advcontent::where('advid', '=', $id)->exists()){
            return response()->json(['code' => 0, 'msg' => '该广告位下有广告记录，请先删除广告内容。' ]);
        }
        $content->delete();

        return response()->json(['code' => 1, 'msg' => '删除成功' ]);
    }

}
