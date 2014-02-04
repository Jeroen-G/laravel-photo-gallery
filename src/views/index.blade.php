@section('content')

	<div class="row">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <b>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 2) }}</b>
            </div>
            <div class="panel-body">
                @if ($allAlbums->count())
                    <dl class="dl-horizontal">
                		@foreach($allAlbums as $album)
                			<dt>{{ link_to("gallery/album/$album->album_id", $album->album_name) }}</dt>
                			<dd><blockquote class="lead">{{ $album->album_description }}</blockquote></dd>
                		@endforeach
                    </dl>
            	@else
                	<b>{{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.album', 2) }}</b>
            	@endif
            </div>
        </div>
    </div>
    
@stop