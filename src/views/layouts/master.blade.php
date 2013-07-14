<!doctype html>
<html>
	<head>
    	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    	<style type="text/css">
    		form ul {list-style: none};
    	</style>
    </head>

    <body>
    	<div class="navbar navbar-inverse">
			<div class="navbar-inner">
		    	<a class="brand" href="#">Photo Gallery</a>
		    	<ul class="nav">
		      		<li>{{ link_to('gallery', 'Home') }}</li>
		      		<li>{{ link_to('gallery/new/album', 'New album') }}</li>
		      		<li>{{ link_to('gallery/new/photo', 'Add photo') }}</li>
		    	</ul>
		  	</div>
		</div>

    	<div class="container">
    		@if (Session::has('message'))
            	<div class="flash alert">
            		<p>{{ Session::get('message') }}</p>
        		</div>
			@endif

    		@yield('content')
        </div>

        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	</body>

</html>