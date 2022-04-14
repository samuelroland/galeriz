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



    public function test_followed_galleries_page_exists()
    {
        $author = User::first();

        $this->actingAs($author)->get(route('followedGalleries'))->assertStatus(200);;
    }

    public function test_followed_galleries_page_is_guarded()
    {
        $this->get(route('followedGalleries'))->assertRedirect(route('login'));
    }

    public function test_it_contains_title_and_description()
    {
        $author = User::first();

        $response = $this->actingAs($author)->get(route('followedGalleries'));

        $response->assertSee("Followed galleries");
        $response->assertSee("Here are all the galleries you follow on Galeriz.");
    }
}
