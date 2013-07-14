@section('content')
	
	<a href='{{ URL::to("gallery/album/$photo->album_id") }}'>{{ Lang::get('gallery::gallery.return') }}</a>

	<h1>{{ $photo->photo_name }}</h1>
	
	{{ Form::open(array('method' => 'DELETE', 'url' => array('gallery/photo', $photo->photo_id))) }}
        {{ link_to("gallery/edit/photo/$photo->photo_id", Lang::get('gallery::gallery.edit'), array('class' => 'btn btn-info')) }}
        {{ Form::submit(Lang::get('gallery::gallery.delete'), array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}

	<img src='{{ asset("uploads/photos/" . $photo->photo_path ) }}' />

	<blockquote class="lead">{{ $photo->photo_description }}</blockquote>
	
@stop