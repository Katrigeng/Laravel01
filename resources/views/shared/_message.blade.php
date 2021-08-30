@foreach (['danger', 'success', 'warning', 'info'] as $type)
  @if (session()->has($type))
    <div class="flash-message">
      <div class="alert alert-{{ $type }}">
        {{ session()->get($type) }}
      </div>
    </div>
  @endif
@endforeach
