<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 第一个参数默认为当前登录用户实例，第二个参数则为要进行授权的用户实例
    // 调用时，默认情况下，我们 不需要 传递当前登录用户至该方法内，因为框架会自动加载当前登录用户
    public function update(User $curentUser, User $user){
        return $curentUser->id === $user->id;
    }


    public function destroy(User $curentUser, User $user){
        return $curentUser->id !== $user->id && $curentUser->is_admin;
    }

    //关注的时候不能关注自己
    public function follow(User $curentUser, User $user){
        return $curentUser->id !== $user->id;
    }
}
