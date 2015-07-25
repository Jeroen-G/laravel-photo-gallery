<?php

use JeroenG\LaravelPhotoGallery\Traits\Creators;
use JeroenG\LaravelPhotoGallery\Entities as Entity;

class AlbumEntityTest extends PHPUnit_Framework_TestCase
{
    use Creators;

    public function testGettersAlbumEntity()
    {
        $album = new Entity\Album();
        $album->map([
            'id' => 1,
            'name' => 'First Album',
            'description' => 'Hello World!',
            'extra' => 'Metadata'
        ]);
        
        $this->assertEquals($album->getId(), 1);
        $this->assertEquals($album->getName(), 'First Album');
        $this->assertEquals($album->getDescription(), 'Hello World!');
        $this->assertTrue($album->metadataContains('extra'));
        $this->assertEquals($album->getMetadata('extra'), 'Metadata');
    }

    public function testRenameAlbum()
    {
        $album = $this->createAlbum(null, false);
        $album->rename('Second Album');

        $this->assertEquals($album->getName(), 'Second Album');
    }

    public function testEditAlbum()
    {
        $album = $this->createAlbum(null, false);
        $album->edit(['name' => 'New Album', 'description' => 'Hallo Wereld!']);

        $this->assertEquals($album->getName(), 'New Album');
        $this->assertEquals($album->getDescription(), 'Hallo Wereld!');
    }

    public function testAddAndGetPhotos()
    {
        $album = $this->createAlbum(null, false);
        $photo1 = $this->createPhoto(null, false);
        $photo2 = $this->createPhoto(null, false);
        $album->addPhotos([$photo1, $photo2]);
        $photos = $album->getPhotos();

        $array = [$photo1->getId() => $photo1, $photo2->getId() => $photo2];
        $this->assertEquals($photos->toArray(), $array);
    }
}