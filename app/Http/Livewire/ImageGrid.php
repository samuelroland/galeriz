<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;

class ImageGrid extends Component
{
    public $gallery;
    public $edit = false;

    //Listen to newImageEvent to render again (to have $gallery->images refreshed from the database)
    protected $listeners = ['newImageEvent' => 'render'];

    public function render()
    {
        return view('livewire.image-grid');
    }

    //Delete an image by id
    public function delete($id)
    {
        $image = Image::find($id);

        if ($image->canBeDeletedIn($this->gallery)) {
            $image->delete();

            //Make sure to refresh the content of $gallery to see the updated images list on the view
            $this->gallery->refresh();
        }
    }
}
