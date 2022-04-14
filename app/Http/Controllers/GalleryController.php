<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
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
        return redirect(route('galleries.show', $gallery));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function myGalleries()
    {
        return $this->index(Auth::user()->galleries, "My galleries", "Here are all the galleries you published on Galeriz.");
    }

    public function followedGalleries()
    {
        return $this->index(Auth::user()->followedGalleries, "Followed galleries",  "Here are all the galleries you follow on Galeriz.");
    }

    public function panorama()
    {
        return $this->index(Gallery::all(), "Panorama", "Panorama of all galleries published on Galeriz.");
    }

    //List all galleries. The galleries can be given to have a filtered list.
    protected function index($galleries, $title, $description)
    {
        return view('galleries.index', ['galleries' => $galleries, 'title' => $title, 'description' => $description]);
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
