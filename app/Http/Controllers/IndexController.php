<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Content;
use App\Adv;
use App\Like;
use App\Comment;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $this->navBar();
        $this->hotContent();
        $recommend = Content::where('status', '2')->get();   // 新增代码
        $advcontent = [];
        $advlist = Adv::where('name', 'imgbox')->get();
        foreach ($advlist as $key => $value) {
            foreach ($value->content as $k => $v) {
                $advcontent= explode('|', $v->path);
            }
        }
        $list = Category::orderBy('id', 'desc')->get()->take(4);
        return view('index', ['recommend' => $recommend, 'adv' => $advcontent, 'list' => $list]);

    }

    protected function navBar(){
        $data = Category::orderBy('sort', 'asc')->get()->toArray();
        $category = $sub = [];
        foreach($data as $k=>$v){
            if ($v['pid'] != 0) {
                $sub[$v['id']] = $v;
            }
        }
        foreach($data as $key=>$val){
            if ($val['pid'] == 0) {
                $category[$key] = $val;
            }
            foreach($sub as $subv) {
                if ($subv['pid'] == $val['id']) {
                    $category[$key]['sub'][] = $subv;
                }
            }
        }
        return view()->share('category', $category);
    }

    public function lists($id)
    {
        if(!$id){
            return redirect('/')->with('tip','缺少参数');
        }
        $this->navBar();
        $this->hotContent();
        $content = Content::where('cid', $id)->paginate(4);
        return view('lists', ['id' => $id, 'content' => $content]);
    }

    public function detail($id)
    {
        if(!$id){
            return redirect('/')->with('tip','缺少参数');
        }
        $this->navBar();
        $this->hotContent();
        $content = Content::find($id);
        $count = Like::where('cid', $id)->get()->count();
        $comments = Comment::where('cid', $id)->get();
        return view('detail', ['id' => $content->id, 'cid' => $content->cid,
            'content' => $content, 'count' => $count, 'comments' => $comments]);
    }

    public function like($id)
    {
        if(!$id){
            return response()->json(['status'=>'2','msg'=>'缺少参数']);
        }
        @session_start();
        $data = array(
            'uid' => session()->get('users.id'),
            'cid' => $id
        );
        $re = Like::create($data);
        if($re){
            $count = Like::where('cid', $id)->get()->count();
            return response()->json(['status'=>'1', 'msg'=>'点赞成功', 'count'=>$count]);
        }else{
            return response()->json(['status'=>'2', 'msg'=>'点赞失败']);
        }
    }

    public function comment(Request $request)
    {
        $cid = $request->input('cid');
        $content = $request->input('content');
        $uid = session()->get('users.id');
        if(!$content){
            return response()->json(['status'=>'2', 'msg'=>'缺少参数']);
        }
        $data = array(
            'uid' => $uid,
            'cid' => $cid,
            'content' => $content,
        );
        $re = Comment::create($data);
        if ($re) {
            $theComment = Comment::where('cid', $cid)->where('uid', $uid)->orderBy('id','desc')->first();
            $theComment->created_time = date('Y-m-d', strtotime($theComment->created_at));
            $count = Comment::where('cid', $cid)->get()->count();
            $theComment->count = $count;
            $theComment->user = $theComment->user->name;
            return response()->json(['status' => '1', 'msg' => '评论成功',
                'data' => $theComment]);
        } else {
            return response()->json(['status' => '2', 'msg' => '评论失败']);
        }

    }

    protected function hotContent(){
        $hotContent = Like::select('cid',DB::raw('count(*) as num'))->orderBy('num', 'desc')->groupBy('cid')->get()->take(2);
        return view()->share('hotContent', $hotContent);
    }


}
