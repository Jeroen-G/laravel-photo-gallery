@section('content')

	<h1>{{ Lang::get('gallery::gallery.all') }}</h1>

	@foreach($allAlbums as $album)
		<h3>{{ $album->album_name }}</h3>
		<p>{{ $album->album_description }}</p>
	@endforeach

@stop