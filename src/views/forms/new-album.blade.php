{{ Form::open(array('url' => 'gallery/album', 'method' => 'POST')) }}
    <ul>
         <li>
            {{ Form::label('album_name', Lang::get('gallery::gallery.name') . ':') }}
            {{ Form::text('album_name', null, $options = array('size'=>'50')) }}
        </li>

        <li>
            {{ Form::label('album_description', Lang::get('gallery::gallery.desc') . ':') }}
            {{ Form::text('album_description', null, $options = array('size'=>'30')) }}
        </li>

        <li>
            {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

