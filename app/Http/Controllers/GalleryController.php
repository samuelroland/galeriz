<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function store()
    {
        if (request()->all() == null) {
            return view('galleries.create');
        }

        request()->validate([
            'title' => 'required|max:25',
            'description' => 'required|max:1000'
        ]);

        $gallery = request(['title', 'description']);
        $gallery['user_id'] = Auth::user()->id;

        $gallery = Gallery::create($gallery);
        return redirect(route('gallery', ['gallery' => $gallery->id]));
    }

    public function myGalleries()
    {
        $galleries = Auth::user()->galleries;
        return view('galleries.index', ['galleries' => $galleries]);
    }
}
