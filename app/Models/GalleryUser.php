<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryUser extends Model
{
    use HasFactory;

    public $table = "gallery_user";

    public $timestamps = false;
}
