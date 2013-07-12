<?php namespace JeroenG\LaravelPhotoGallery\Models;

class Album extends \Eloquent {
    
    protected $table = 'albums';

    protected $primaryKey = 'album_id';

    protected $guarded = array();

    public function photos()
    {
    	return $this->hasMany('\JeroenG\LaravelPhotoGallery\Models\Photo');
    }

}