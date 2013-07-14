@section('content')

	<h1>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 2) }}</h1>

	@if ($allAlbums->count())
		@foreach($allAlbums as $album)
			<h3>{{ link_to("gallery/album/$album->album_id", $album->album_name) }}</h3>
			<blockquote class="lead">{{ $album->album_description }}</blockquote>
		@endforeach

	@else
    	{{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.album', 2) }}
	@endif

@stop