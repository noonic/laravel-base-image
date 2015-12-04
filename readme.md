# Laravel Image Uploader and Cropper

- Upload images
- Crop image
- Creates thumbnails with various configurable sizes
- Aspect ratio option
- Uses Iframe to upload file

## Installation
**1. Add the package to your application**

**`/composer.json`**
```
{
    "require": {
        "noonic/image": "dev-master"
    }
}
```

**2. Add Provider and Facade**

**`/config/app.php`**
```
'providers' => [
    ...
    Noonic\Image\ImageServiceProvider::class,
];

'aliases' => [
    ...
    'Image'     => Noonic\Image\ImageHelperFacade::class,
];
```

**3 Publish package files:**
```
php artisan vendor:publish
```

**4. Make output directory writable:**
```
chmod 777 -R /public/images/uploads/ 
```

**5. Include JavaScript Helper file**

**`/resources/views/app.blade.php`**
```
<script type="text/javascript" src="{{ URL::asset('js/noonic.image.js') }}"></script>
```

## Usage

```blade
{!! Form::open() !!}
  @include('noonic_image::_input', [
      'name' => 'photo', 
      'folder' => 'photos', 
      'data' => '', 
      'required' => true
  ])
{!! Form::close() !!}
```

## Options

- **name**: [required] [String] Name of file input
- **ratio**: [optional] [String] [4/3, 16:9, 1/1] Image ratio to crop and resize. Default: 4/3.
- **folder**: [optional] [String] Name of folder where the image will be uploaded. Default: 'default' folder
- **data**: [optional] [String] Pass image path to prefill data
- **required**: [optional] [Boolean] [true / false] To make the image required, prompts JavaScript Alert box.

## Requirements
- PHP GD library
- Jquery
- Twitter Bootstrap

## Screenshots
### 1. Form
![Screenshot 1](http://nooniclab.com/laravel-base/website/public/images/screenshots/image/uploader-1.png "Screenshot 1")
---
### 2. Iframe image uploader
![Screenshot 2](http://nooniclab.com/laravel-base/website/public/images/screenshots/image/uploader-2.png "Screenshot 2")
---
### 3. After uploading image cropping area selection
![Screenshot 3](http://nooniclab.com/laravel-base/website/public/images/screenshots/image/uploader-3.png "Screenshot 3")
---
### 4. Corp success and show cropped image inside iframe
![Screenshot 4](http://nooniclab.com/laravel-base/website/public/images/screenshots/image/uploader-4.png "Screenshot 4")
---
### 5. Form with uploaded and cropped image preview
![Screenshot 5](http://nooniclab.com/laravel-base/website/public/images/screenshots/image/uploader-5.png "Screenshot 5")
---

## Authors

Atul Yadav - [GitHub](https://github.com/atulmy) &bull; [Twitter](https://twitter.com/atulmy)

## License

Copyright (c) 2015 Noonic Lab http://github.com/noonic

The MIT License (http://www.opensource.org/licenses/mit-license.php)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
