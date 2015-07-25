<?php

use JeroenG\LaravelPhotoGallery\Traits\Creators;
use JeroenG\LaravelPhotoGallery\Adapters\InMemory as Adapter;

class AlbumAdapterTest extends PHPUnit_Framework_TestCase
{
    use Creators;

    protected $albums;

    public function setUp()
    {
        $this->albums  = new Adapter\InMemoryAlbumAdapter();
    }

    public function testGetAllAlbums()
    {
        $album = $this->createAlbum();
        $this->assertEquals($this->albums->all()->first(), $album);
    }

    public function testFindAlbum()
    {
        $album = $this->createAlbum();
        $search = $this->albums->find($album->getId());
        $this->assertEquals($search, $album);
    }

    public function testfindByName()
    {
        $album = $this->createAlbum();
        $search = $this->albums->findByAttribute(['name' => $album->getName()])->first();
        $this->assertEquals($search, $album);
    }

    public function testFindHiddenAlbum()
    {
        $album = $this->createAlbum();
        $this->albums->hide($album);
        $search = $this->albums->find($album->getId());
        $this->assertFalse($search, $album);
        $searchHidden = $this->albums->findHidden($album->getId());
        $this->assertEquals($searchHidden, $album);
    }

    public function testRestoreHiddenAlbum()
    {
        $album = $this->createAlbum();
        $this->albums->hide($album);
        $search = $this->albums->find($album->getId());
        $this->assertFalse($search, $album);
        $this->albums->restore($album);
        $search2 = $this->albums->find($album->getId());
        $this->assertEquals($search2, $album);   
    }

    public function testSave()
    {
        $album = $this->createAlbum();
        $album->rename('New Album');
        $this->albums->save($album);
        $search = $this->albums->find($album->getId());
        $this->assertEquals($search, $album);
    }

    public function testDelete()
    {
        $album = $this->createAlbum();
        $this->albums->delete($album);
        $search = $this->albums->find($album->getId());
        $this->assertFalse($search, $album);
    }
}