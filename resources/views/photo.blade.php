@section('content')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ $photo->photo_name }}</b>
            <div class="pull-right">
                <a class="btn btn-default" href="{{ URL::route('gallery.album.show', array('id' => $photo->album_id)) }}">{{ Lang::get('gallery::gallery.return') }}</a>
            </div>
        </div>
        <div class="panel-body">
            <img class="img" src='{{ asset("uploads/photos/" . $photo->photo_path ) }}' />
        </div>
        <div class="panel-footer clearfix">
    	    {{ $photo->photo_description }}
            {{ Form::open(array('route' => array("gallery.album.photo.destroy", $photo->album_id, $photo->photo_id))) }}
                    {{ link_to_route("gallery.album.photo.edit", Lang::get('gallery::gallery.edit'), array('albumId' => $photo->album_id, 'photoId' => $photo->photo_id), array('class' => 'btn btn-info')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit(Lang::get('gallery::gallery.delete'), array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
        </div>
    </div>
</div>
	
@stop