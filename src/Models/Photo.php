<?php

namespace JeroenG\LaravelPhotoGallery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    /**
     * The table used by this model
     *
     * @var string
     **/
    protected $table = 'photos';

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