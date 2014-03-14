@section('content')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ $photo['photo']['title'] }}</b>
            <div class="pull-right">
                <a class="btn btn-default" href="{{ URL::previous() }}">{{ Lang::get('gallery::gallery.return') }}</a>
            </div>
        </div>
        <div class="panel-body">
            <img class="img" src="http://farm{{$photo['photo']['farm']}}.staticflickr.com/{{$photo['photo']['server']}}/{{$photo['photo']['id']}}_{{$photo['photo']['secret']}}.jpg">
        </div>
        <div class="panel-footer clearfix">
    	    {{ $photo['photo']['description'] }}
        </div>
    </div>
</div>
	
@stop