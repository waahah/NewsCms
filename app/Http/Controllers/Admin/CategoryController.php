<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function add(){
        $category = Category::where('pid', 0)->get();
        return view('admin.category.add', ['category' => $category] );
    }

    public function save(Request $request){
        $data = $request->all();
        $rule = isset($data['id']) ? ',name,'.$data['id'] : '';
        $this->validate($request,[
            'name'=>'required|unique:category'.$rule,
        ],[
            'name.required'=>'栏目名称不能为空',
            'name.unique'=>'栏目名称不能重复'
        ]);
        if(isset($data['id'])){
            $id = $data['id'];
            unset($data['id']);
            unset($data['_token']);
            $res = Category::where('id',$id)->update($data);
            $type = $res ? "message" : "tip";
            $message = $res ? "修改成功" : "修改失败";
            return redirect('category')->with($type, $message);
        }
        $re = Category::create($data);
        if($re){
            return redirect('category')->with('message','添加成功');
        }else{
            return redirect('category/add')->with('tip','添加失败');
        }
    }

    public function index(){
        $data = Category::orderBy('sort', 'asc')->get()->toArray();
        $category = $this->getTreeListCheckLeaf($data);
        return view('admin.category.index', ['category' => $category]);
    }

    public function getTreeListCheckLeaf($data, $name = 'isLeaf')
    {
        $data = $this->treeList($data);
        foreach ($data as $k => $v) {
            foreach ($data as $vv) {
                $data[$k][$name] = true;
                if ($v['id'] === $vv['pid']) {
                    $data[$k][$name] = false;
                    break;
                }
            }
        }
        return $data;
    }

    public function treeList($data, $pid = 0, $level = 0, &$tree = [])
    {
        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level;
                $tree[] = $v;
                $this->treeList($data, $v['id'], $level + 1, $tree);
            }
        }
        return $tree;
    }

    public function sort(Request $request){
        $sort = $request->input('sort');
        foreach ($sort as $k => $v) {
            Category::where('id', (int)$k)->update(['sort' => (int)$v]);
        }
        return redirect('category')->with('message','改变排序成功');
    }

    public function edit($id){
        $data = [];
        if ($id) {
            if (!$data = Category::find($id)) {
                return back()->with('tip', '记录不存在。');
            }
        }
        $category = Category::where('pid', 0)->get();
        return view('admin.category.edit', ['id'=>$id, 'data'=>$data, 'category' => $category]);
    }

    public function delete($id){
        if (!$category = Category::find($id)) {
            return response()->json(['code' => 0, 'msg' => '删除失败，记录不存在。' ]);
        }
        $category->delete();
        return response()->json(['code' => 1, 'msg' => '删除成功' ]);
    }

}
