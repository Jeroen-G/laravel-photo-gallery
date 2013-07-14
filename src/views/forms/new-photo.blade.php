{{ Form::open(array('url' => 'gallery/photo', 'method' => 'POST', 'files' => true)) }}
    <ul>
        <li>
            {{ Form::label('photo_name', Lang::get('gallery::gallery.name') . ':') }}
            {{ Form::text('photo_name', null, $options = array('size'=>'50')) }}
        </li>

        <li>
            {{ Form::label('photo_path', Lang::get('gallery::gallery.path') . ':') }}
            {{ Form::file('photo_path') }}
        </li>

        <li>
            {{ Form::label('album_id', Lang::choice('gallery::gallery.album', 1) . ':') }}
            {{ Form::select('album_id', $dropdown) }}
        </li>

        <li>
            {{ Form::label('photo_description', Lang::get('gallery::gallery.desc') . ':') }}
            {{ Form::textarea('photo_description', null, $options = array('size'=>'50x5')) }}
        </li>

        <li>
            {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}