{{ Form::open(array('route' => 'gallery.album.store', 'method' => 'POST')) }}

    <div class="form-group">
        {{ Form::label('album_name', Lang::get('gallery::gallery.name') . ':') }}
        {{ Form::text('album_name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('album_description', Lang::get('gallery::gallery.desc') . ':') }}
        {{ Form::text('album_description', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn btn-primary')) }}
    </div>

{{ Form::close() }}

