@extends('gallery::layouts.master')

@section('content')
<form method="POST" action="{{ route('gallery.album.destroy', ['id' => $album->getId()]) }}">
    <input name="_method" type="hidden" value="DELETE">
    {!! csrf_field() !!}
    <a href="{{ route('gallery.album.edit', ['id' => $album->getId()]) }}" class="btn btn-primary">{{ trans('gallery::gallery.edit') }}</a>
    <input class="btn btn-danger" type="submit" value="{{ trans('gallery::gallery.delete') }}">
</form>
<div class="row">
  @if (count($albumPhotos))
    @foreach($albumPhotos as $photo)
      <div class="card">
        <a href="{{ route('gallery.album.photo.show', ['albumId' => $photo->getAlbum(), 'photoId' => $photo->getId()]) }}"><img data-src="holder.js/100%x280/thumb"></a>
        <p class="card-text">
          <h3><a href="{{ route('gallery.album.photo.show', ['albumId' => $photo->getAlbum(), 'photoId' => $photo->getId()]) }}">{{$photo->getName()}}</a></h3>
          {{ $photo->getDescription() }}</p>
      </div>
    @endforeach
  @else
  <div class="card">
    <h3>{{ trans('gallery::gallery.none') . trans_choice('gallery::gallery.photo', 2) }}</h3>
  </div>
  @endif
</div>
@endsection