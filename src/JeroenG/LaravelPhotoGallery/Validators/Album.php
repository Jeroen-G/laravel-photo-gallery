<?php namespace JeroenG\LaravelPhotoGallery\Validators;

class Album extends Validator {

	/**
     * The rules for validating the input
     *
     * @var array
     **/
    public static $rules = array(
    		'album_name' => 'required',
            'album_description' => 'max:255',
    	);
}