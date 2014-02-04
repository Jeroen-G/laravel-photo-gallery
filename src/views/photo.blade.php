@section('content')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ $photo->photo_name }}</b>
            <div class="pull-right">
                <a class="btn btn-default" href='{{ URL::to("gallery/album/$photo->album_id") }}'>{{ Lang::get('gallery::gallery.return') }}</a>
            </div>
        </div>
        <div class="panel-body">
            <img class="img" src='{{ asset("uploads/photos/" . $photo->photo_path ) }}' />
        </div>
        <div class="panel-footer clearfix">
    	    {{ $photo->photo_description }}
            {{ Form::open(array('method' => 'DELETE', 'url' => array('gallery/photo', $photo->photo_id), 'class'=>'pull-right')) }}
                {{ link_to("gallery/edit/photo/$photo->photo_id", Lang::get('gallery::gallery.edit'), array('class' => 'btn btn-info')) }}
                {{ Form::submit(Lang::get('gallery::gallery.delete'), array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
	
@stop