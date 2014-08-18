<?php 

class PhotosTags extends Eloquent
{
    protected $table = 'photos_tags';
	protected $fillable = array('movie_id','name_id','char_id','desc');
	public static $rules = array(
       'photo_id' => 'integer',
       'tag_id' => 'integer',
       'tag_desc' => 'text',
       'tag_type' => 'text'
    );
}