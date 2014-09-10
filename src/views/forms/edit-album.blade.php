{{ Form::model($album, array('method' => 'PUT', 'route' => array('gallery.album.update', $album->album_id))) }}

    <div class="form-group">
        {{ Form::label('album_name', Lang::get('gallery::gallery.name') . ':') }}
        {{ Form::text('album_name', null, $options = array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('album_description', Lang::get('gallery::gallery.desc') . ':') }}
        {{ Form::text('album_description', null, $options = array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn btn-primary')) }}
        {{ link_to_route("gallery.album.show", Lang::get('gallery::gallery.cancel'), array($album->album_id), array('class' => 'btn btn-default')) }}
    </div>

{{ Form::close() }}