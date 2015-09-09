<form method="POST" action="{{ route('gallery.album.photo.update', ['albumId' => $photo->getAlbum(), 'photoId' => $photo->getId()]) }}">
    <input name="_method" type="hidden" value="PUT">
    {!! csrf_field() !!}
    <fieldset class="form-group">
        <label for="photo_name">{{trans('gallery::gallery.name')}}:</label>
        <input class="form-control" type="text" name="photo_name" id="photo_name" value="{{$photo->getName()}}">
    </fieldset>

    <fieldset class="form-group">
        <label for="album_id">{{trans_choice('gallery::gallery.album', 1)}}:</label>
        <select name="album_id">
            @foreach ($dropdown as $id => $option)
                <option value="{{$id}}" <?php if($id == $photo->getAlbum()) echo 'selected' ?> >{{$option}}</option>
            @endforeach
        </select>
    </fieldset>

    <fieldset class="form-group">
        <label for="photo_description">{{trans('gallery::gallery.desc')}}:</label>
        <textarea class="form-control" name="photo_description" id="photo_description">{{$photo->getDescription()}}</textarea>
    </fieldset>

    <fieldset class="form-group">
        <input class="btn btn-primary" type="submit" class="form-control" value="{{trans('gallery::gallery.submit')}}">
        <a href="{{ route('gallery.album.photo.show', ['albumId' => $photo->getAlbum(), 'photoId' => $photo->getId()]) }}" class="btn btn-secondary">{{trans('gallery::gallery.cancel')}}</a>
    </fieldset>
</form>