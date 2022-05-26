<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Content;

class ContentController extends Controller
{
    public function add()
    {
        $data = Category::orderBy('sort', 'asc')->get()->toArray();
        $cate = new CategoryController();
        $category = $cate->getTreeListCheckLeaf($data);
        return view('admin.content.add', ['category' => $category]);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $this->validate($request,[
            'cid'=>'required',
            'title'=>'required'
        ],[
            'cid.require'=>'分类不能为空',
            'title.require'=>'标题不能为空'
        ]);
        if(isset($data['id'])){
            $id = $data['id'];
            unset($data['id']);
            unset($data['_token']);
            $res = Content::where('id',$id)->update($data);
            $type = $res ? "message" : "tip";
            $message = $res ? "修改成功" : "修改失败";
            return redirect('content')->with($type, $message);
        }

        $re = Content::create($data);
        if($re){
            return redirect('content')->with('message','添加成功');
        }else{
            return redirect('content/add')->with('tip','添加失败');
        }
    }

    public function upload(Request $request)
    {
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

    public function index($id = 0)
    {
        $data = Category::orderBy('sort', 'asc')->get()->toArray();
        $cate = new CategoryController();
        $category = $cate->getTreeListCheckLeaf($data);
        $content = Content::get();
        if ($id) {
            $content = Content::where('cid', $id)->get();
        }
        return view('admin.content.index', ['category' => $category, 'content' => $content, 'cid' => $id]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Category::orderBy('sort', 'asc')->get()->toArray();
        $cate = new CategoryController();
        $category = $cate->getTreeListCheckLeaf($data);
        $content = Content::find($id);
        return view('admin.content.edit', ['category' => $category, 'content' => $content]);
    }

    public function delete($id)
    {
        if (!$content = Content::find($id)) {
            return response()->json(['code' => 0, 'msg' => '删除失败，记录不存在。' ]);
        }
        $content->delete();
        return response()->json(['code' => 1, 'msg' => '删除成功' ]);
    }
}
