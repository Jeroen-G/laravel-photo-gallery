<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Laravel Photo Gallery</title>

      <!-- Bootstrap core CSS -->
      <link href="{{ asset('vendor/gallery/css/bootstrap.min.css') }}" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="{{ asset('vendor/gallery/css/album.css') }}" rel="stylesheet">

      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{ asset('vendor/gallery/js/ie10-viewport-bug-workaround.js') }}"></script>
    </head>

    <body>
        @include('gallery::partials.header')

        <div class="album text-muted">
          <div class="container">

            @if(Session::has('alertinfo'))
              <div class="alert alert-info">
                <p>{{ Session::get('alertinfo') }}</p>
              </div>
            @endif

            @if(Session::has('alertsuccess'))
              <div class="alert alert-success">
                <p>{{ Session::get('alertsuccess') }}</p>
              </div>
            @endif

            @if(Session::has('alertwarning'))
              <div class="alert alert-warning">
                <p>{{ Session::get('alertwarning') }}</p>
              </div>
            @endif

            @if(Session::has('alertdanger'))
              <div class="alert alert-danger">
                <p>{{ Session::get('alertdanger') }}</p>
              </div>
            @endif

            @yield('content')
          </div>
        </div>
        
        @include('gallery::partials.footer')

    </body>
</html>