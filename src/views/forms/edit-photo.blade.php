<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('js/tagsinput.js')}}"></script>
<script type="text/javascript" src="{{asset('js/typeahead.js')}}"></script>
<link href="{{asset('css/tagsinput.css')}}" rel="stylesheet">
<script type="text/javascript">
 $(document).ready(function(){
     $('input.tag').tagsinput({
  typeahead: {                  
    source: function(query) {
    console.log(query)
      return $.get('JSON Return URL'+query);
    }
  }
});
 });
 </script>
{{ Form::model($photo, array('method' => 'PUT', 'url' => array('gallery/photo', $photo->photo_id))) }}
    <ul>
        <li>
            {{ Form::label('photo_name', Lang::get('gallery::gallery.name') . ':') }}
            {{ Form::text('photo_name', null, $options = array('size'=>'50')) }}
        </li>

        <li>
            {{ Form::label('photo_path', Lang::get('gallery::gallery.path') . ':') }}
            {{ Form::text('photo_path', null, $options = array('size'=>'50')) }}
        </li>

        <li>
            {{ Form::label('album_id', Lang::get('gallery::gallery.album') . ':') }}
            {{ Form::select('album_id', $dropdown) }}
        </li>

        <li>
            {{ Form::label('photo_description', Lang::get('gallery::gallery.desc') . ':') }}
            {{ Form::textarea('photo_description', null, $options = array('size'=>'50x5')) }}
        </li>

        <li>
            Tags:
            <input type="text" name="tags" id="tag" value="" class="tag" /> 
        </li>

        <li>
            {{ Form::submit(Lang::get('gallery::gallery.submit'), array('class' => 'btn')) }}
            {{ link_to("gallery/photo/$photo->photo_id", Lang::get('gallery::gallery.cancel'), array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}