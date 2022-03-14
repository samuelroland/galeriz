<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function create()
    {
        $gallery = request(['title', 'description']);
        $gallery['user_id'] = Auth::user()->id;

        Gallery::create($gallery);
        return redirect(route('panorama'));
    }
}
