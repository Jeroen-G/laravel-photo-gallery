<?php

use JeroenG\LaravelPhotoGallery\Traits\Creators;
use JeroenG\LaravelPhotoGallery\Entities as Entity;

class PhotoEntityTest extends PHPUnit_Framework_TestCase
{
    public function testGettersPhotoEntity()
    {
        $photo = new Entity\Photo();
        $photo->map([
            'id' => 1,
            'name' => 'Profile',
            'description' => 'Profile picture',
            'file' => 'images/profiles/user13.jpg',
            'size' => '50x50',
            'album' => 20,
            'extra' => 'Metadata'
        ]);
        
        $this->assertEquals($photo->getId(), 1);
        $this->assertEquals($photo->getName(), 'Profile');
        $this->assertEquals($photo->getDescription(), 'Profile picture');
        $this->assertEquals($photo->getFile(), 'images/profiles/user13.jpg');
        $this->assertEquals($photo->getSize(), '50x50');
        $this->assertEquals($photo->getAlbum(), 20);
        $this->assertTrue($photo->metadataContains('extra'));
        $this->assertEquals($photo->getMetadata('extra'), 'Metadata');
    }

    public function testEditPhoto()
    {
        $photo = new Entity\Photo();
        $photo->map([
            'name' => 'Holiday photo',
            'description' => 'What a fun!'
        ]);
        $photo->edit(['description' => 'What an experience!']);

        $this->assertEquals($photo->getDescription(), 'What an experience!');
    }
}