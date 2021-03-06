@extends('layouts.default')
@section('title', '重置密码')

@section('content')
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header"><h5>重置密码</h5></div>

      <div class="card-body">
        {{-- session('status')不知道有什么用 --}}
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <form action="{{ route('password.email') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="email">邮箱地址：</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
            @if ($errors->has('email'))
              <span class="form-text" style="color: red">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">发送重置密码邮件</button>
          </div>

        </form>
      </div>
    </div>

  </div>
@endsection

