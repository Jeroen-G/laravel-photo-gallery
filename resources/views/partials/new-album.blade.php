<form method="POST" action="{{ route('gallery.album.store') }}">
    {!! csrf_field() !!}
    <fieldset class="form-group">
        <label for="album_name">{{trans('gallery::gallery.name')}}:</label>
        <input class="form-control" type="text" name="album_name" id="album_name">
    </fieldset>

    <fieldset class="form-group">
        <label for="album_description">{{trans('gallery::gallery.desc')}}:</label>
        <textarea class="form-control" name="album_description" id="album_description"></textarea>
    </fieldset>

    <fieldset class="form-group">
        <input class="btn btn-primary" type="submit" class="form-control" value="{{trans('gallery::gallery.submit')}}">
        <a href="{{ route('gallery') }}" class="btn btn-secondary">{{trans('gallery::gallery.cancel')}}</a>
    </fieldset>
</form>
