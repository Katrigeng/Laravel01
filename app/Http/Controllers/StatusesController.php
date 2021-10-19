<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Status;

class StatusesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request){
        $request->validate(['content' => 'required|max:140']);
        Auth::user()->statuses()->create([
            'content' => $request->content
        ]);
        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    public function destroy(Status $status){
        //做删除授权的检测，不通过会抛出 403 异常。
        $this->authorize('destroy', $status);
        //调用 Eloquent 模型的 delete 方法对该微博进行删除。
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }

}
