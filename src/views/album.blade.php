@section('content')

	<h1>{{ Lang::get('gallery::gallery.album') . ' ' . $album->album_name }}</h1>

	@if ($albumPhotos->count())
		@foreach($albumPhotos as $photo)
			<h3>{{ $photo->photo_name }}</h3>
			<p>{{ $photo->photo_description }}</p>
		@endforeach

	@else
    	{{ Lang::get('gallery::gallery.none') }}
	@endif

	{{ Form::open(array('method' => 'DELETE', 'url' => array('gallery/album', $album->album_id))) }}
		{{ link_to("gallery/edit/album/$album->album_id", Lang::get('gallery::gallery.edit'), array('class' => 'btn btn-info')) }}
	    {{ Form::submit(Lang::get('gallery::gallery.delete'), array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}

@stop