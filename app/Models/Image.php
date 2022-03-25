<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    //Get the path of the image or the path of the default "not found" image
    public function getSafePathAttribute()
    {
        $defaultImagePath = "image-not-found.png";

        if (trim($this->path) == "") {
            return $defaultImagePath;
        }

        if (Storage::disk('public')->exists($this->path)) {
            return $this->path;
        } else {
            return $defaultImagePath;
        }
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
