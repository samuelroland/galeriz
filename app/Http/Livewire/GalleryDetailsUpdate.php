<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GalleryDetailsUpdate extends Component
{
    public $gallery;

    protected $rules = [
        'gallery.title' => 'required|max:25',
        'gallery.description' => 'required|max:1000'
    ];

    public function render()
    {
        return view('livewire.gallery-details-update');
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $this->gallery->save(); //this will be reached only if data are validated

        //Set the flashmessage
        session()->flash('updateMessage', 'Gallery details successfully updated!');
    }
}
