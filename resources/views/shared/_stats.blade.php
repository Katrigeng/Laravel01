<a href="{{ route('users.followings', $user->id) }}">
  <strong>{{ count($user->followings) }}</strong>
  关注
</a>
<a href="{{ route('users.followers', $user->id) }}">
  <strong>{{ count($user->followers) }}</strong>
  粉丝
</a>
<a href="{{ route('users.show', $user->id) }}">
  <strong>{{ count($user->statuses) }}</strong>
  微博
</a>
