<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class ImageController extends Controller
{
    public static function uploadImage($image)
    {
        $imageName = Uuid::generate()->string . '.' . 'png';
        $destinationPath = public_path('/images/product/thumb');
        $img = \Intervention\Image\Facades\Image::make($image);
        // backup status
        $img->backup();
        //image for thumb
        $img->resize(200, 200)->save($destinationPath . '/' . $imageName);
        $img->reset();
        //image for for slider
        $destinationPath = public_path('/images/product/feature');
        $img->resize(800, 800)->save($destinationPath . '/' . $imageName);
        $img->reset();
        //uploading original image
        $destinationPath = public_path('/images/product');
        $img->save($destinationPath . '/' . $imageName);
        return $imageName;
    }
}
