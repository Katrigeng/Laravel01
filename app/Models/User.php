<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Status;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    // boot 方法会在用户模型类完成初始化之后进行加载，因此我们对事件的监听需要放在该方法中。
    public static function boot()
    {

        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });

    }

    public function statuses(){
        return $this->hasMany(Status::class);
    }

    public function feed(){
        $user_ids = $this->followings->pluck('id')->toArray();
        array_push($user_ids, $this->id);
        return Status::whereIn('user_id', $user_ids)
                            ->with('user')
                            ->orderBy('created_at', 'desc');
    }

    //用户的粉丝列表
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //用户的关注列表
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //关注
    public function follow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        return $this->followings()->sync($user_ids, false);
    }

    //取消关注
    public function unfollow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        return $this->followings()->detach($user_ids);
    }

    //当前用户 是否关注 某某用户
    public function isFollowing($user_ids){
        //这里注意 不能写成 $this->followings()->contains($user_ids),不能加多个括号
        return $this->followings->contains($user_ids);
    }

}
