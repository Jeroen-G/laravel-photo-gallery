{{ Form::open(array('route' => 'gallery.album.photo.store', 'method' => 'POST', 'files' => true)) }}
        
    <div class="form-group">
        {{ Form::label('photo_name', Lang::get('gallery::gallery.name') . ':') }}
        {{ Form::text('photo_name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('photo_path', Lang::get('gallery::gallery.path') . ':') }}
        {{ Form::file('photo_path', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('album_id', Lang::choice('gallery::gallery.album', 1) . ':') }}
        {{ Form::select('album_id', $dropdown, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('photo_description', Lang::get('gallery::gallery.desc') . ':') }}
        {{ Form::textarea('photo_description', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn btn-primary')) }}
    </div>

{{ Form::close() }}