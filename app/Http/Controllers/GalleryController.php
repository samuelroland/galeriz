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
        request()->validate([
            'title' => 'required|max:25',
            'description' => 'required|max:1000'
        ]);

        $gallery = request(['title', 'description']);
        $gallery['user_id'] = Auth::user()->id;

        $gallery = Gallery::create($gallery);
        return redirect(route('galleries.show', ['gallery' => $gallery->id]));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function myGalleries()
    {
        return $this->index(Auth::user()->galleries);
    }

    public function followedGalleries()
    {
        return $this->index(Auth::user()->followedGalleries);
    }

    //List all galleries. The galleries can be given to have a filtered list.
    public function index($galleries = null)
    {
        if ($galleries == null) {
            $galleries = Gallery::all();
        }

        return view('galleries.index', ['galleries' => $galleries]);
    }

    public function show(Gallery $gallery)
    {
        return view('galleries.show', ['gallery' => $gallery]);
    }

    public function update(Gallery $gallery)
    {
        if ($gallery->author()->isNot(Auth::user())) {
            return redirect(route('galleries.show', ['gallery' => $gallery]));
        }
        return view('galleries.update', ['gallery' => $gallery]);
    }
}
