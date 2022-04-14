<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\UnauthorizedException;

class Image extends Model
{
    use HasFactory;

    //Get the path of the image or the path of the default "not found" image
    public function getSafePathAttribute()
    {
        $defaultImagePath = "image-not-found.png";
        $path = "images/" . $this->id;
        return Storage::disk('local')->exists($path) ? $path : $defaultImagePath;
    }

    public function getPathAttribute()
    {
        return "images/" . $this->id;
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    //Better delete() method to delete db record and file on disk
    public function delete()
    {
        //Before deletion, we need to remove the cover image if the image is the cover of its gallery
        if ($this->gallery->cover?->is($this)) {
            $this->gallery->cover_id = null;
            $this->gallery->save();
        }

        //delete the model record normally
        parent::delete();

        //and delete the file too
        Storage::disk('local')->delete($this->path);
    }

    public function canBeDeletedIn(Gallery $gallery)
    {
        //Check if the image is present in the gallery and if the gallery is owned by the user
        return $gallery->images->contains($this) && $gallery->author->is(auth()->user());
    }
}
