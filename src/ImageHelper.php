<?php

namespace Noonic\Image;

use Illuminate\Support\Facades\File;

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

    public static function getImageUrl($filename, $size = '', $default = '')
    {
        if(filter_var($filename, FILTER_VALIDATE_URL)) {
            return $filename;
        }

        $image = '';

        if($filename != '' && strlen($filename) !== 0) {
            if($size !== '') {
                if(File::exists(public_path('images/uploads' . self::getImage($filename, $size)))) {
                    $image = asset('images/uploads' . self::getImage($filename, $size));
                } else if(File::exists(public_path('images/uploads' . $filename))) {
                    $image = asset('images/uploads'.$filename);
                } else {
                    $image = asset('images/uploads'.self::getImage($default, $size));
                }
            } else {
                if(File::exists(public_path('/images/uploads'.$filename))) {
                    $image = asset('images/uploads'.$filename);
                } else {
                    $image = asset('images/uploads'.self::getImage($default, $size));
                }
            }
        } else {
            $image = asset('images/uploads'.self::getImage($default, $size));
        }
        return $image;
    }
}