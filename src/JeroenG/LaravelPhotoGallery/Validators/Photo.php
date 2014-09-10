<?php namespace JeroenG\LaravelPhotoGallery\Validators;

class Photo extends Validator {

	/**
     * The rules for validating the input
     *
     * @var array
     **/
    public static $rules = array(
    		'photo_path' => 'image|required',
    		'album_id' => 'required',
            'photo_name' => 'required',
            'photo_description' => 'max:255',
    	);
}