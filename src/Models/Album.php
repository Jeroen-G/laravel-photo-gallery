<?php namespace JeroenG\LaravelPhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;
use JeroenG\LaravelPhotoGallery\Contracts\Album as AlbumContract;

class Album extends Model implements AlbumContract {
    
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
    *  Enabling soft deleting
    *
    *  @var boolean
    **/
     protected $softDelete = true;

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