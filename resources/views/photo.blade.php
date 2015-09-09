@extends('gallery::layouts.master')

@section('content')
<p><a class="btn btn-primary" href="{{ route('gallery.album.show', ['id' => $photo->getAlbum()]) }}">{{ trans('gallery::gallery.return') }}</a></p>
<form method="POST" action="{{ route('gallery.album.photo.destroy', ['albumId' => $photo->getAlbum(), 'photoId' => $photo->getId()]) }}">
    <input name="_method" type="hidden" value="DELETE">
    {!! csrf_field() !!}
    <a href="{{ route('gallery.album.photo.edit', ['albumId' => $photo->getAlbum(), 'photoId' => $photo->getId()]) }}" class="btn btn-primary">{{ trans('gallery::gallery.edit') }}</a>
    <input class="btn btn-danger" type="submit" value="{{ trans('gallery::gallery.delete') }}">
</form>

<p><img class="img" src='{{ asset("uploads/photos/" . $photo->getFile() ) }}' /></p>

@endsection