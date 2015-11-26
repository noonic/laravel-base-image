<?php

namespace Noonic\Image\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Noonic\Image\ImageHelper;

class ImagesController extends Controller
{
    protected $rules = [
        'image' => ['required', 'mimes:jpeg,jpg,png'],
        'target' => ['required'],
        'folder' => ['required']
    ];

    protected $uploadsDirectory;

    public function __construct()
    {
        $this->uploadsDirectory = base_path().'/public/'.Config::get('noonic_image.uploads_directory');
    }

    public function loading()
    {
        return view('noonic_image::loading');
    }

    public function uploader($target = 'image', $id = 'image', $folder = 'default')
    {
        return view('noonic_image::uploader', compact('target', 'id', 'folder'));
    }

    public function uploadImage(Request $request)
    {
        $error = 'Invalid file.';

        $this->validate($request, $this->rules);

        $input = Input::all();

        if($input['image']->isValid()) {
            $size = getimagesize($input['image']);

            $sizes = $this->getSizes($input['ratio']);

            if(isset($size[0]) && $size[0] >= $sizes['s'][0] && isset($size[1]) && $size[1] >= $sizes['s'][1]) {
                $extension = $input['image']->getClientOriginalExtension(); // getting image extension
                $fileName = md5(date('ymdhis')) . '.' . $extension; // renaming image
                $saveDirectory = '/' . $input['folder'] . '/' . substr($fileName, 0, 1);
                if (!file_exists($this->uploadsDirectory . $saveDirectory)) {
                    mkdir($this->uploadsDirectory . $saveDirectory, 0777, true);
                }
                $input['image']->move($this->uploadsDirectory . $saveDirectory, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');

                return redirect()->route('image_cropper', ['target' => $input['target'], 'id' => $input['id'], 'directory' => base64_encode($saveDirectory), 'image' => base64_encode($fileName), 'folder' => $input['folder']]);
            } else {
                $error = 'L\'immagine &egrave; troppo piccola, usane una pi&ugrave; grande! Dimensioni minime: '.$sizes['s'][0].' x '.$sizes['s'][1].' pixel.';
            }
        }

        return redirect()->route('image_uploader', ['target' => $input['target'], 'id' => $input['id'], 'folder' => $input['folder']])->withErrors(['error' => $error]);
    }

    public function cropper($target, $id, $directory, $image, $folder)
    {
        if($target != '' && $directory != '' && $image != '') {
            $directory = base64_decode($directory);
            $image = base64_decode($image);
            return view('noonic_image::cropper', compact('target', 'id', 'directory', 'image', 'folder'));
        }

        return redirect()->route('image_uploader', $target);
    }

    public function crop()
    {
        $input = Input::all();

        $quality = 90;

        $sizes = $this->getSizes($input['ratio']);

        $sourceImage = $this->uploadsDirectory . $input['directory'] . '/' . $input['image'];

        $fileInfo = new \SplFileInfo($sourceImage);
        $fileExtension = $fileInfo->getExtension();

        foreach($sizes as $sizeKey => $size) {
            $croppedImageName = preg_replace('/^(.*)\.' . $fileExtension . '$/', '$1_'.$sizeKey.'.' . $fileExtension, $input['image']);
            $croppedImageFullPath = $this->uploadsDirectory . $input['directory'] . '/'.$croppedImageName;

            if($fileExtension === 'jpg' || $fileExtension === 'jpeg') {
                $jpgImage = imagecreatefromjpeg($sourceImage);
                $jpgTempImage = imagecreatetruecolor($size[0], $size[1]);
                imagecopyresampled($jpgTempImage, $jpgImage, 0, 0, $input['x'], $input['y'], $size[0], $size[1], $input['w'], $input['h']);
                imagejpeg($jpgTempImage, $croppedImageFullPath, $quality);
            } else if($fileExtension === 'png') {
                $pngImage = imagecreatefrompng($sourceImage);
                $pngTempImage = imagecreatetruecolor($size[0], $size[1]);
                imagecopyresampled($pngTempImage, $pngImage, 0, 0, $input['x'], $input['y'], $size[0], $size[1], $input['w'], $input['h']);
                imagepng($pngTempImage, $croppedImageFullPath, round((100 - $quality) * 0.09));
            }
        }

        $previewSize = isset($input['preview_size']) ? $input['preview_size'] : 't';
        $imageUrl = asset('images/uploads'.$input['directory'].'/'.ImageHelper::getImage($input['image'], $previewSize));

        return redirect()->route('image_done', [
            'target' => $input['target'],
            'id' => $input['id'],
            'directory' => base64_encode($input['directory']),
            'image' => base64_encode($input['image']),
            'url' => base64_encode($imageUrl)
        ]);
    }

    public function done($target, $id, $directory, $image, $url)
    {
        if($target != '' && $directory != '' && $image != '') {
            $directory = base64_decode($directory);
            $image = base64_decode($image);
            $url = base64_decode($url);
            return view('noonic_image::done', compact('target', 'id', 'directory', 'image', 'url'));
        }

        return redirect()->route('image_uploader', $target);
    }

    private function getSizes($ratio)
    {
        $sizes = [];
        switch($ratio) {
            case '1/1':
                $sizes = Config::get('noonic_image.sizes')['1:1'];
                break;

            case '16/9':
                $sizes = Config::get('noonic_image.sizes')['16:9'];
                break;

            case '4/3':
            default:
                $sizes = Config::get('noonic_image.sizes')['4:3'];
                break;
        }
        return $sizes;
    }

    public function getInput()
    {
        $input = Input::all();

        if(isset($input['name']) && isset($input['folder'])) {
            return view('noonic_image::_input', [
                'name' => $input['name'],
                'id' => isset($input['id']) ? $input['id'] : $input['name'],
                'folder' => $input['folder'],
                'data' => isset($input['data']) ? $input['data'] : ''
            ]);
        } else {
            return "Missing input data";
        }
    }
}