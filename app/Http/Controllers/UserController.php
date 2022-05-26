<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $rule = [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required'
        ];
        $message = [
            'name.require' => '用户名不能为空',
            'name.unique' => '用户名不能重复',
            'email.require' => '邮箱不能为空',
            'email.email' => '邮箱格式不符合规范',
            'password.require' => '密码不能为空',
            'password.min' => '密码最少为6位',
            'password.confirmed' => '密码和确认密码不一致'
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $v) {
                $msg = $v[0];
            }
            return response()->json(['status' => '2', 'msg' => $msg]);
        }
        $re = User::create($request->all());
        if ($re) {
            Session::put('users', ['id' => $re->id, 'name' => $re->name]); // 注册成功后保存登录状态
            return response()->json(['status' => '1', 'msg' => '注册成功']);
        } else {
            return response()->json(['status' => '2', 'msg' => '注册失败']);
        }

    }

    public function login(Request $request)
    {
        $rule = [
            'name' => 'required|bail',
            'password' => 'required|min:6'
        ];
        $message = [
            'name.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
            'password.min' => '密码最少为6位'
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $v) {
                $msg = $v[0];
            }
            return response()->json(['status'=>'2', 'msg'=>$msg]);
        }
        $name = $request->get('name');
        $password = $request->get('password');
        $theUser = User::where('name', $name)->first();
        if ($theUser) {
            if ($password == $theUser->password) {
                Session::put('users', ['id' => $theUser->id,'name' => $name]);
                return response()->json(['status' => '1', 'msg' => '登录成功']);
            } else {
                return response()->json(['status' => '2', 'msg' => '密码错误']);
            }
        } else {
            return response()->json(['status' => '2', 'msg' => '用户不存在']);
        }
    }

    public function logout()
    {
        if (request()->session()->has('users')) {
            request()->session()->pull('users', session('users'));
        }
        return redirect('/');
    }

}
