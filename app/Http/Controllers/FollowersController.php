<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //点击关注
    public function store(User $user){
        //判断是否有权限
        $this->authorize('follow', $user);
        //判断是否已经关注
        if(!Auth::user()->isFollowing($user->id)){
            Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }

    //点击取消关注
    public function destroy(User $user){
        //判断是否有权限
        $this->authorize('follow', $user);
        //判断是否已经关注
        if(Auth::user()->isFollowing($user->id)){
            Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
