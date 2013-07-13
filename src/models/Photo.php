<?php namespace JeroenG\LaravelPhotoGallery\Models;

class Photo extends \Eloquent {
    
    protected $table = 'photos';

    protected $primaryKey = 'photo_id';

    protected $guarded = array();

    protected $touches = array('Album');

    public $rules = array(
    		'path' => 'image|required',
    		'album' => 'required',
            'description' => 'max:255',
    	);

    public function album()
    {
    	return $this->belongsTo('\JeroenG\LaravelPhotoGallery\Models\Album');
    }

}