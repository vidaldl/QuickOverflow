<a title="Favorite"
   class="favorite mt-2 {{Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '')}}"
   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
>
    <i class="fa fa-star fa-2x"></i>
    <span class="favorite-count">{{ $model->favorites_count }}</span>
</a>
<form id="favorite-question-{{$model->id}}" action="/questions/{{ $model->id }}/favorites" method="POST" style="display: none;">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>
