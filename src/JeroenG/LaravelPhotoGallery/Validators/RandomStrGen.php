<?php namespace JeroenG\LaravelPhotoGallery\Validators;

class RandomStrGen extends Validator {

	protected $length;


	public function __construct($input = 20)
	{
		$this->length = $input;
	}

	public function stringGenerate()
  	{
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $this->length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
  	}
}