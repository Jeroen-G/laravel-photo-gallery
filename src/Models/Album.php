<?php

namespace JeroenG\LaravelPhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    
    /**
     * The table used by this model
     *
     * @var string
     **/
    protected $table = 'albums';

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
     * Defining the relationship, an album could have many photos
     *
     * @return \JeroenG\LaravelPhotoGallery\Models\Photo
     **/
    public function photos()
    {
    	return $this->hasMany('\JeroenG\LaravelPhotoGallery\Models\Photo');
    }

}