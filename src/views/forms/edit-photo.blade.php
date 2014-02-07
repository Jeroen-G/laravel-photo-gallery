{{ Form::model($photo, array('method' => 'PUT', 'route' => array('gallery.album.photo.update', $photo->album_id, $photo->photo_id))) }}
    <ul>
        <li>
            {{ Form::label('photo_name', Lang::get('gallery::gallery.name') . ':') }}
            {{ Form::text('photo_name', null, $options = array('size'=>'50')) }}
        </li>

        <li>
            {{ Form::label('photo_path', Lang::get('gallery::gallery.path') . ':') }}
            {{ Form::text('photo_path', null, $options = array('size'=>'50')) }}
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
            {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn btn-primary')) }}
            {{ link_to_route("gallery.album.photo.show", Lang::get('gallery::gallery.cancel'), array($photo->album_id, $photo->photo_id), array('class' => 'btn btn-default')) }}
        </li>
    </ul>
{{ Form::close() }}