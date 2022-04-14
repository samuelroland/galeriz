<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show(Image $image)
    {
        if (\Str::startsWith(request()->header('Accept'), "image/")) {
            return Storage::download($image->safePath);
        } else {
            return ""; //empty request if the client doesn't expect an image
        }
    }
}
