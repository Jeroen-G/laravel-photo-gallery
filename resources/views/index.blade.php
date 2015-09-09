@extends('gallery::layouts.master')

@section('content')
<div class="row">
  @if (count($allAlbums))
    @foreach($allAlbums as $album)
      <div class="card">
        <a href="{{ route('gallery.album.show', ['id' => $album->getId()]) }}"><img data-src="holder.js/100%x280/thumb" alt="Card image cap"></a>
        <p class="card-text">
          <h3><a href="{{ route('gallery.album.show', ['id' => $album->getId()]) }}">{{$album->getName()}}</a></h3>
          {{ $album->getDescription() }}</p>
      </div>
    @endforeach
  @else
  <div class="card">
    <h3>{{trans('gallery::gallery.none') . trans_choice('gallery::gallery.album', 2)}}</h3>
  </div>
  @endif
</div>
@endsection