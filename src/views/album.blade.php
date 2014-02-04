@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ Lang::get('gallery::gallery.overview') . ' ' . Lang::choice('gallery::gallery.album', 1) . ': ' . $album->album_name }}</b>
            <div class="pull-right">
                {{ Form::open(array('method' => 'DELETE', 'url' => array('gallery/album', $album->album_id))) }}
            		{{ link_to("gallery/edit/album/$album->album_id", Lang::get('gallery::gallery.edit'), array('class' => 'btn btn-info')) }}
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
                            <b>{{ link_to("gallery/photo/$photo->photo_id", $photo->photo_name) }}</b>
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