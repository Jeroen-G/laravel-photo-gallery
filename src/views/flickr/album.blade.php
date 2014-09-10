@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 1) . ': ' . $album->title['_content'] }}</b>
        </div>
        <div class="panel-body">

        @if (count($albumPhotos->photo))
            <div class="row">
            @foreach($albumPhotos->photo as $photo)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>{{ link_to_route("gallery.album.photo.show", $photo['title'], array($album->id, $photo['id'])) }}</b>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="panel-footer clearfix">
           <?php $totalPages = $albumPhotos->pages; ?>
            @include('gallery::layouts.pagination');
        </div>
        @else
            {{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.photo', 2) }}
            </div>
        @endif


    </div>
@stop