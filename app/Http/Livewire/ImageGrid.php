<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImageGrid extends Component
{
    public $gallery;
    public $edit = false;

    protected $listeners = ['newImageEvent' => 'render'];

    public function render()
    {
        return view('livewire.image-grid');
    }
}