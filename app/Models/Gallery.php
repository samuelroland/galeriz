<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function cover()
    {
        return $this->belongsTo(Image::class, 'cover_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
