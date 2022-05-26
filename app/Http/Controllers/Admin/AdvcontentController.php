<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Adv;
use App\Advcontent;

class AdvcontentController extends Controller
{
    public function add($id = 0){
        $data = [];
        if($id > 0){
            $data = Advcontent::find($id);
            if($data['path']){
                $data['path'] = explode("|", $data['path']);
            }else{
                $data['path'] = [];
            }
        }
        $position = Adv::all();
        return view('admin.advcontent.add', ['data' => $data, 'position' => $position]);
    }

    public function save(Request $request){
        $data = $request->all();
        $path = '';
        foreach($data['path'] as $v){
            $path .= $v . "|";
        }
        $data['path'] = substr($path,0,-1);
        if(isset($data['id'])){
            $id = $data['id'];
            unset($data['id']);
            unset($data['_token']);
            $res = Advcontent::where('id',$id)->update($data);
            $type = $res ? "message" : "tip";
            $message = $res ? "修改成功" : "修改失败";
            return redirect('advcontent')->with($type, $message);
        }

        $re = Advcontent::create($data);
        if($re){
            return redirect('advcontent')->with('message','添加成功');
        }else{
            return redirect('advcontent/add')->with('tip','添加失败');
        }
    }

    public function upload(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $name = md5(microtime(true)) . '.' . $image->extension();
                $image->move('static/upload', $name);
                $path = '/static/upload/' . $name;
                $returndata  = array(
                    'filename' => $name,
                    'path' => $path
                );
                $result = [
                    'code' => 1,
                    'msg'  => '上传成功',
                    'time' => time(),
                    'data' => $returndata,
                ];

                return response()->json($result);
            }
            return $image->getErrorMessage();
        }
        return '文件上传失败';

    }

    public function index(){
        $adv = Advcontent::all();
        foreach($adv as $v){
            if($v['path']){
                $v['path'] = explode("|", $v['path']);
            }else{
                $v['path'] = [];
            }
        }
        return view('admin.advcontent.index', ['adv' => $adv]);
    }

    public function delete($id){
        if (!$content = Advcontent::find($id)) {
            return response()->json(['code' => 0, 'msg' => '删除失败，记录不存在。' ]);
        }
        $content->delete();
        return response()->json(['code' => 1, 'msg' => '删除成功' ]);
    }


}
