<?php namespace JeroenG\LaravelPhotoGallery\Models;

class Album extends \Eloquent {
    
    /**
     * The table used by this model
     *
     * @var string
     **/
    protected $table = 'albums';

    /**
     * The primary key
     *
     * @var string
     **/
    protected $primaryKey = 'album_id';

    /**
     * The fields that are guarded cannot be mass assigned
     *
     * @var array
     **/
    protected $guarded = array();

    /**
     * The rules for validating the input
     *
     * @var array
     **/
    public $rules = array(
    		'album_name' => 'required',
            'album_description' => 'max:255',
    	);

    /**
     * Defining the relationship, an album could have many photos
     *
     * @return \JeroenG\LaravelPhotoGallery\Models\Photo
     **/
    public function photos()
    {
    	return $this->hasMany('\JeroenG\LaravelPhotoGallery\Models\Photo');
    }

}