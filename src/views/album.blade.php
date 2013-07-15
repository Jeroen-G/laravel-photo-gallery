@section('content')

	<h1>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 1) . ': ' . $album->album_name }}</h1>

	{{ Form::open(array('method' => 'DELETE', 'url' => array('gallery/album', $album->album_id))) }}
		{{ link_to("gallery/edit/album/$album->album_id", Lang::get('gallery::gallery.edit'), array('class' => 'btn btn-info')) }}
	    {{ Form::submit(Lang::get('gallery::gallery.delete'), array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}
    
	@if ($albumPhotos->count())
		<dl>
		@foreach($albumPhotos as $photo)
			<dt><h3>{{ link_to("gallery/photo/$photo->photo_id", $photo->photo_name) }}</h3></dt>
			<dd><p class="lead indent">{{ $photo->photo_description }}</p></dd>
		@endforeach

	<?php echo $albumPhotos->links(); ?>
		</dl>

	@else
    	{{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.photo', 2) }}
	@endif

@stop