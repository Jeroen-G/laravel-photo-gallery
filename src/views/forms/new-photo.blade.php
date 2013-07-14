{{ Form::open(array('url' => 'gallery/photo', 'method' => 'POST', 'files' => true)) }}
    <ul>
        <li>
            {{ Form::label('name', Lang::get('gallery::gallery.name') . ':') }}
            {{ Form::text('name', null, $options = array('size'=>'50')) }}
        </li>

        <li>
            {{ Form::label('path', Lang::get('gallery::gallery.path') . ':') }}
            {{ Form::file('path') }}
        </li>

        <li>
            {{ Form::label('album', Lang::get('gallery::gallery.album') . ':') }}
            {{ Form::select('album', $dropdown) }}
        </li>

        <li>
            {{ Form::label('description', Lang::get('gallery::gallery.desc') . ':') }}
            {{ Form::textarea('description', null, $options = array('size'=>'50x5')) }}
        </li>

        <li>
            {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}