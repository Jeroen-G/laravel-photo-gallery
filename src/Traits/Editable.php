<?php

namespace JeroenG\LaravelPhotoGallery\Traits;

trait Editable
{
    public function edit(array $metadata)
    {
        foreach ($metadata as $key => $value) {
            $this->metadata[$key] = $value;
        }
        return $this;
    }
}