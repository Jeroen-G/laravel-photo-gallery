<div class="navbar">
  <a class="navbar-brand" href="#">Gallery</a>
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="{{route('gallery')}}">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('gallery.album.create')}}">{{trans_choice('gallery::gallery.create', 1) .' '. trans_choice('gallery::gallery.album', 1)}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('gallery.album.photo.create')}}">{{trans_choice('gallery::gallery.create', 2) .' '. trans_choice('gallery::gallery.photo', 1)}}</a>
    </li>
  </ul>
</div>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">Laravel Photo Gallery</h1>
    <p class="lead text-muted">This is just to give you a start, customize it for your needs!</p>
    <p>
      <a href="https://github.com/Jeroen-G/laravel-photo-gallery" class="btn btn-primary">Github</a>
    </p>
  </div>
</section>