<?php

namespace Noonic\Image;

class ImageHelper
{
    public static function getImage($filename, $size = 's')
    {
        if(filter_var($filename, FILTER_VALIDATE_URL)) {
            return $filename;
        }
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        return preg_replace('/^(.*)\.' . $extension . '$/', '$1_'.$size.'.' . $extension, $filename);
    }

    public static function getImageUrl($filename, $size = '')
    {
        if(filter_var($filename, FILTER_VALIDATE_URL)) {
            return $filename;
        }

        $image = '';

        if($filename != '' && strlen($filename) !== 0) {
            if($size !== '') {
                if(File::exists(public_path('images/uploads' . getImage($filename, $size)))) {
                    $image = asset('images/uploads' . getImage($filename, $size));
                } else if(File::exists(public_path('images/uploads' . $filename))) {
                    $image = asset('images/uploads' . $filename);
                }
            } else {
                if(File::exists(public_path('/images/uploads'.$filename))) {
                    $image = asset('images/uploads'.$filename);
                }
            }
        }
        return $image;
    }
}