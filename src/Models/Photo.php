<?php

namespace JeroenG\LaravelPhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    /**
     * The table used by this model
     *
     * @var string
     **/
    protected $table = 'photos';

    /**
    *  Enabling soft deleting
    *
    *  @var boolean
    **/
     protected $softDelete = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * When this model is updated, the updated_at timestamp of the album is also changed
     *
     * @var array
     **/
    protected $touches = array('album');

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