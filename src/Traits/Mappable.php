<?php

namespace JeroenG\LaravelPhotoGallery\Traits;

trait Mappable
{
    public function map(array $metadata)
    {
        if(isset($this->metadata['id']))
        {
            throw new \Exception("The data can only be mapped once.");
        }

        foreach ($metadata as $key => $value) {
            $this->metadata[$key] = $value;
        }
        return $this;
    }

    public function toArray()
    {
        return $this->metadata;
    }
}