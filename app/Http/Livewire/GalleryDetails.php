<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GalleryDetails extends Component
{
    public $gallery;

    public function render()
    {
        return view('livewire.gallery-details');
    }
}