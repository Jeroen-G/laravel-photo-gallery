{{ Form::model($album, array('method' => 'PUT', 'route' => array('gallery.album.update', $album->album_id))) }}
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
            {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn btn-primary')) }}
            {{ link_to_route("gallery.album.show", Lang::get('gallery::gallery.cancel'), array($album->album_id), array('class' => 'btn btn-default')) }}
        </li>
    </ul>
{{ Form::close() }}