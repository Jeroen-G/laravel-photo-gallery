@section('content')
	
	<a href="{{ URL::to('gallery') }}">{{ Lang::get('gallery::gallery.return') }}</a>

	<h1>{{ $photo->photo_name }}</h1>

	<img src='{{ asset("uploads/photos/" . $photo->photo_path ) }}' />

@stop