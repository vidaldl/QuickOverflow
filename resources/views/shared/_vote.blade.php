@if($model instanceof App\Question)
    @php
        $name ='question';
        $firstURISegment = 'questions';
    @endphp
@elseif($model instanceof App\Answer)
    @php
        $name ='answer';
        $firstURISegment = 'answers';
    @endphp
@endif
@php
    $formId = $name . "-" . $model->id;
    $formAction ="/{$firstURISegment}/{$model->id}/vote";

@endphp
<div class="d-flex flex-column vote-controls">
    <a title="Mark as useful"
       class="vote-up {{ Auth::guest() ?  'off' : ''}}" href=""
       onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();"
    >
        <i class="fa fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{ $name }}-{{$model->id}}" action="{{ $formAction }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>


    <span class="votes-count">{{ $model->votes_count }}</span>


    <a title="Mark as not useful"
       class="vote-down {{ Auth::guest() ?  'off' : ''}}" href=""
       onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();"
    >
        <i class="fa fa-caret-down fa-3x"></i>
    </a>
    <form id="down-vote-{{ $name }}-{{$model->id}}" action="{{ $formAction }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if($model instanceof App\Question)
       <favorite :question="{{ $model }}"></favorite>
    @elseif($model instanceof App\Answer)
        <accept :answer="{{ $model }}"></accept>
    @endif
</div>
