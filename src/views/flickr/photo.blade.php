@section('content')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>{{ $photo->title['_content'] }}</b>
            <div class="pull-right">
                <a class="btn btn-default" href="{{ URL::previous() }}">{{ Lang::get('gallery::gallery.return') }}</a>
            </div>
        </div>
        <div class="panel-body">
            <img class="img" src="http://farm{{$photo->farm}}.staticflickr.com/{{$photo->server}}/{{$photo->id}}_{{$photo->secret}}.jpg">
        </div>
        <div class="panel-footer clearfix">
            {{ $photo->description['_content'] }}
        </div>
    </div>
</div>
    
@stop