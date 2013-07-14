@section('content')

<h1>{{ Lang::get('gallery::gallery.edit') . ' ' . Lang::choice("gallery::gallery.$type", 1) }}</h1>

{{ $form }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop


