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
        //Check if the image is present in the gallery
        if ($this->gallery->images->contains($image)) {

            //Check if the gallery is owned by the user
            if ($this->gallery->author->is(auth()->user())) {

                //Before final deletion, we need to remove the cover image if this image is the cover
                if ($this->gallery->cover?->is($image)) {
                    $this->gallery->cover_id = null;
                    $this->gallery->save();
                }

                $image->delete();

                //Make sure to refresh the content of $gallery to see the updated images list on the view
                $this->gallery->refresh();
            }
        }
    }
}
