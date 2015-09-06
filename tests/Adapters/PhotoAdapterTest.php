<?php

use JeroenG\LaravelPhotoGallery\Traits\Creators;
use JeroenG\LaravelPhotoGallery\Adapters\InMemory as Adapter;

class PhotoAdapterTest extends PHPUnit_Framework_TestCase
{
    use Creators;

    protected $photos;

    public function setUp()
    {
        $this->photos  = new Adapter\InMemoryPhotoAdapter();
    }

    public function testGetAllPhotos()
    {
        $photo = $this->createPhoto();
        $this->assertEquals($this->photos->all()->first(), $photo);
    }

    public function testFindPhoto()
    {
        $photo = $this->createPhoto();
        $search = $this->photos->find($photo->getId());
        $this->assertEquals($search, $photo);
    }

    public function testfindByName()
    {
        $photo = $this->createPhoto();
        $search = $this->photos->findByAttribute(['name' => $photo->getName()])->first();
        $this->assertEquals($search, $photo);
    }

    public function testfindByAlbumId()
    {
        $photo = $this->createPhoto();
        $search = $this->photos->findByAlbumId($photo->getAlbum())->first();
        $this->assertEquals($search, $photo);
    }

    public function testFindHiddenPhoto()
    {
        $photo = $this->createPhoto();
        $this->photos->hide($photo);
        $search = $this->photos->find($photo->getId());
        $searchHidden = $this->photos->findHidden($photo->getId());
        $searchHiddenFalse = $this->photos->findHidden($photo->getId()+1);
        
        $this->assertFalse($search, $photo);
        $this->assertEquals($searchHidden, $photo);
        $this->assertFalse($searchHiddenFalse, $photo);
    }

    public function testRestoreHiddenPhoto()
    {
        $photo = $this->createPhoto();
        $this->photos->hide($photo);
        $search = $this->photos->find($photo->getId());
        $this->assertFalse($search, $photo);
        $this->photos->restore($photo);
        $search2 = $this->photos->find($photo->getId());
        $this->assertEquals($search2, $photo);   
    }

    public function testSave()
    {
        $photo = $this->createPhoto();
        $photo->edit(['description' => 'What an experience!']);
        $this->photos->save($photo);
        $search = $this->photos->find($photo->getId());
        $this->assertEquals($search, $photo);
    }

    public function testUpdate()
    {
        $photo = $this->createPhoto();
        $photo->edit(['description' => 'What an experience!']);
        $this->photos->update($photo);
        $search = $this->photos->find($photo->getId());
        $this->assertEquals($search, $photo);
    }

    public function testDelete()
    {
        $photo = $this->createPhoto();
        $this->photos->delete($photo);
        $search = $this->photos->find($photo->getId());
        $this->assertFalse($search, $photo);

        $photo = $this->createPhoto();
        $this->photos->hide($photo);
        $this->photos->delete($photo);
        $search = $this->photos->find($photo->getId());
        $this->assertFalse($search, $photo);
    }
}