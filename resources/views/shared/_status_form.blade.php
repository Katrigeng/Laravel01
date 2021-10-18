<form action="{{ route('statuses.store') }}" method="POST">
  @include('shared._errors')
  {{ csrf_field() }}
  <textarea class="form-control" id="content" name="content" placeholder="聊聊新鲜事儿..." rows="3">{{ old('content') }}</textarea>
  <div class="text-right">
    <button class="btn btn-primary mt-3">发布</button>
  </div>
</form>
