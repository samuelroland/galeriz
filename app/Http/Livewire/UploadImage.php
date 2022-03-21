<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImage extends Component
{
    use WithFileUploads;

    public $gallery;
    public $title;
    public $image;

    protected $rules = [
        'title' => 'required|max:25',
        'image' => 'required'   //image|max:1024
    ];

    public function render()
    {
        return view('livewire.upload-image');
    }

    public function save()
    {
        $data = $this->validate();

        $data['user_id'] = auth()->user()->id;

        $image = new Image;
        $image->title = $this->title;
        $image->path = "";
        $image->save();

        $image->path = "/images/" . $image->id;
        $image->save();

        $this->image->store('images');
    }
}