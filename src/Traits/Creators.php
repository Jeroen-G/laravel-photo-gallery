<?php

namespace JeroenG\LaravelPhotoGallery\Traits; 
use JeroenG\LaravelPhotoGallery\Entities as Entity;

trait Creators
{
    public function createAlbum($data = null, $add = true)
    {
        $faker = \Faker\Factory::create();
        $album = new Entity\Album();
        $metadata = [
            'id' => $faker->unique()->randomDigitNotNull(),
            'name' => $faker->name,
            'description' => $faker->sentence(3)
        ];
        if(!is_null($data)) {
            foreach ($data as $key => $value) {
                $metadata[$key] = $value;
            }
        }
        $album->map($metadata);
        if($add) {
            $this->albums->add($album);
        }
        return $album;
    }

    public function createPhoto($data = null, $add = true)
    {
        $faker = \Faker\Factory::create();
        $photo = new Entity\Photo();
        $metadata = [
            'id' => $faker->unique()->randomDigitNotNull(),
            'name' => $faker->name,
            'description' => $faker->sentence(3),
            'file' => $faker->imageUrl(640, 480),
            'size' => '640x480',
            'album_id' => $faker->unique()->randomDigitNotNull()
        ];
        if(!is_null($data)) {
            foreach ($data as $key => $value) {
                $metadata[$key] = $value;
            }
        }
        $photo->map($metadata);
        if($add) {
            $this->photos->add($photo);
        }
        return $photo;
    }
}