@section('content')

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ Lang::get('gallery::gallery.edit') . ' ' . Lang::choice("gallery::gallery.$type", 1) }}</b>
        </div>
        <div class="panel-body alert alert-info">
            <h3>You should use the Flickr site or apps to create, edit, delete or upload albums and photos</h3>
        </div>
    </div>
</div>

@stop


