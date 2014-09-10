@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 1) . ': ' . $album->album_name }}</b>
            <div class="pull-right">
                {{ Form::open(array('route' => array("gallery.album.destroy", $album->album_id))) }}
                    {{ link_to_route("gallery.album.edit", Lang::get('gallery::gallery.edit'), array('id' => $album->album_id), array('class' => 'btn btn-info')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit(Lang::get('gallery::gallery.delete'), array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </div>
        </div>
        <div class="panel-body">

        @if ($albumPhotos->count())
            <div class="row">
            @foreach($albumPhotos as $photo)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>{{ link_to_route("gallery.album.photo.show", $photo->photo_name, array($photo->album_id, $photo->photo_id)) }}</b>
                        </div>
                        <div class="panel-body">
                            <p class="lead indent">{{ $photo->photo_description }}</p>
                        </div>
                    </div>
                </div>
    		@endforeach
            </div>
        </div>
        <div class="panel-footer clearfix">
    	   <?php echo $albumPhotos->links(); ?>
        </div>
    	@else
        	{{ Lang::get('gallery::gallery.none') . Lang::choice('gallery::gallery.photo', 2) }}
            </div>
    	@endif


    </div>
@stop