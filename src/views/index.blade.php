@section('content')

	<h1>{{ Lang::get('gallery::gallery.all') }}</h1>

	@if ($allAlbums->count())
		@foreach($allAlbums as $album)
			<h3>{{ $album->album_name }}</h3>
			<p>{{ $album->album_description }}</p>
		@endforeach

	@else
    	{{ Lang::get('photos.none') }}
	@endif

@stop