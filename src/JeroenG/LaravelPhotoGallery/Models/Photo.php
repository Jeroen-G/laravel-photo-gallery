<?php namespace JeroenG\LaravelPhotoGallery\Models;

class Photo extends \Eloquent {
    
    /**
     * The table used by this model
     *
     * @var string
     **/
    protected $table = 'photos';

    /**
     * The primary key
     *
     * @var string
     **/
    protected $primaryKey = 'photo_id';

    /**
     * The fields that are guarded cannot be mass assigned
     *
     * @var array
     **/
    protected $guarded = array();

    /**
    *  Enabling soft deleting
    *
    *  @var boolean
    **/
     protected $softDelete = true;

    /**
     * When this model is updated, the updated_at timestamp of the album is also changed
     *
     * @var array
     **/
    protected $touches = array('Album');

    /**
     * Defining the relationship, a photo belongs to an album
     *
     * @return \JeroenG\LaravelPhotoGallery\Models\Album
     **/
    public function album()
    {
    	return $this->belongsTo('\JeroenG\LaravelPhotoGallery\Models\Album');
    }

}