@section('content')

	<h1>{{ Lang::get('gallery::gallery.album') }}</h1>

	@if ($albumPhotos->count())
		@foreach($albumPhotos as $photo)
			<h3>{{ $photo->photo_name }}</h3>
			<p>{{ $photo->photo_description }}</p>
		@endforeach

	@else
    	{{ Lang::get('gallery::gallery.none') }}
	@endif

@stop