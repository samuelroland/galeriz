<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GalleryDetails extends Component
{
    public $gallery;

    protected $rules = [
        'gallery.title' => 'required|max:25',
        'gallery.description' => 'required|max:1000'
    ];

    public function render()
    {
        return view('livewire.gallery-details');
    }

    public function save()
    {
        $this->validate();

        $this->gallery->save();

        $this->gallery->refresh();
    }
}