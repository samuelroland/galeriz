<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowedGalleriesTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true; //seed the database at each run

    public function test_followed_galleries_page_exists()
    {
        $author = User::first();

        $this->actingAs($author)->get(route('followedGalleries'))->assertStatus(200);;
    }
}
