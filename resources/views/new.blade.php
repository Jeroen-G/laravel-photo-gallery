@section('content')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ Lang::get('gallery::gallery.create') . ' ' . Lang::choice("gallery::gallery.$type", 1) }}</b>
        </div>
        <div class="panel-body">

    {{ $form }}

    @if ($errors->any())
            <ul>
                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
            </ul>
    @endif
        </div>
    </div>
</div>

@stop


