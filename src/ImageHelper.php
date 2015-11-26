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

    public static function getImageUrl($filename, $size = '', $default = '')
    {
        if(filter_var($filename, FILTER_VALIDATE_URL)) {
            return $filename;
        }

        // @TODO, i suggest using a caching mechanism
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

        if(strlen($image) == 0 || $image == '') {
            switch($default) {
                case 'menu':
                    $image = '/default/menu.jpg';
                    break;
                case 'event':
                    $image = '/default/event.jpg';
                    break;
                case 'chef':
                    $image = '/default/chef.jpg';
                    break;
                case 'location':
                    $image = '/default/location.jpg';
                    break;
                case 'user':
                    $image = '/default/user.png';
                    break;
            }
            if($size !== '') {
                $image = asset('images/uploads' . getImage($image, $size));
            } else {
                $image = asset('images/uploads'.$filename);
            }
        }
        return $image;
    }
}