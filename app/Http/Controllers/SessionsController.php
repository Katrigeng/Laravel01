<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);

        //登录限流 10分钟10次
        $this->middleware('throttle:10,10',[
            'only' => ['store']
        ]);
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials, $request->has('rememberMe'))){

            //判断是否激活
            if(Auth::user()->activated){
                //登录成功
                session()->flash('success', '欢迎回来！');
                $fallBack = route('users.show', [Auth::user()]);
                return redirect()->intended($fallBack);
            }else{
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }

        }else{
            //登录失败
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return back()->withInput();
        }
    }

    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }

}
