<?php

use Illuminate\Support\Facades\Config;

function get_languages(){

    return \App\Models\Language::active() -> Selection() -> get();    // selesct to active language------*//
}

function get_default_lang(){
  return   Config::get('app.locale');    // get defulte language-----------//
}


function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'uploads/' . $folder . '/' . $filename;
    return $path;

}

function uploadFiles($folder, $files)
{
    $files->store('/', $folder);
    $filename = $files->hashName();
    $path = 'uploads/' . $folder . '/' . $filename;
    return response()->file($path);
    // return Storage::response($path);

}



function uploadVideo($folder, $video)
{
    $video->store('/', $folder);
    $filename = $video->hashName();
    $path = 'video/' . $folder . '/' . $filename;
    return $path;
}


