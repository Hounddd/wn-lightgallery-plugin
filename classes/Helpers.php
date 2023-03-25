<?php

namespace Hounddd\lightGallery\Classes;

use Hounddd\lightGallery\Models\Gallery;

class Helpers
{
    static function listGalleries()
    {
        $galleries = Gallery::isPublished()->get()->lists('name', 'id');

        return $galleries;
    }
}
