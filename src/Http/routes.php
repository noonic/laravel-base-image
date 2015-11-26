<?php

// Image
Route::group(['prefix' => 'image'], function() {
    // loading
    Route::get('/loading', [
        'as' => 'image_loading',
        'uses' => 'ImagesController@loading'
    ]);
    // uploader
    Route::get('/uploader/{target}/{id}/{folder}', [
        'as' => 'image_uploader',
        'uses' => 'ImagesController@uploader'
    ]);
    // upload image
    Route::post('/upload', [
        'as' => 'image_upload_image',
        'uses' => 'ImagesController@uploadImage'
    ]);
    // cropper
    Route::get('/cropper/{target}/{id}/{directory}/{image}/{folder}', [
        'as' => 'image_cropper',
        'uses' => 'ImagesController@cropper'
    ]);
    // crop
    Route::post('/crop', [
        'as' => 'image_crop',
        'uses' => 'ImagesController@crop'
    ]);
    // done
    Route::get('/done/{target}/{id}/{directory}/{image}/{url}', [
        'as' => 'image_done',
        'uses' => 'ImagesController@done'
    ]);
    // get input
    Route::post('/get-input', [
        'as' => 'image_get_input',
        'uses' => 'ImagesController@getInput'
    ]);
});