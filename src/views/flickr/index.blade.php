@section('content')

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <b>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 2) }}</b>
            </div>
            <div class="panel-body">
                @if (count($allAlbums->photoset))
                    <dl class="dl-horizontal">
                        @foreach($allAlbums->photoset as $album)
                            <dt>{{ link_to_route("gallery.album.show", $album['title']['_content'], array($album['id'])) }}</dt>
                            <dd><blockquote class="lead">{{ $album['description']['_content'] }}</blockquote></dd>
                        @endforeach
                    </dl>
                @else
                    <b>{{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.album', 2) }}</b>
                @endif
            </div>
        </div>
    </div>
    
@stop