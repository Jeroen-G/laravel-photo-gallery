<?php namespace JeroenG\LaravelPhotoGallery\Models;

class Album extends \Eloquent {
    
    protected $table = 'albums';

    protected $primaryKey = 'album_id';

    protected $guarded = array();

    public $rules = array(
    		'album_name' => 'required',
            'album_description' => 'max:255',
    	);

    public function photos()
    {
    	return $this->hasMany('\JeroenG\LaravelPhotoGallery\Models\Photo');
    }

}