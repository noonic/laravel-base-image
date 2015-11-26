<?php

namespace Noonic\Image;

use Illuminate\Support\Facades\Facade;

class ImageHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'noonic_image';
    }
}