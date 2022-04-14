<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyGalleriesTest extends TestCase
{
    use RefreshDatabase;



    public function test_my_galleries_page_exists()
    {
        $author = User::first();

        $this->actingAs($author)->get(route('my'))->assertStatus(200);
    }

    public function test_my_galleries_page_is_guarded()
    {
        $this->get(route('my'))->assertRedirect(route('login'));
    }

    public function test_my_galleries_are_all_displayed()
    {
        $user = User::first();
        $galleries = $user->galleries;

        $response = $this->actingAs($user)->get(route('my'));

        $this->assertEquals(substr_count($response->getContent(), 'single-gallery'), $galleries->count());
    }

    public function test_has_title_and_description()
    {
        $user = User::first();

        $response = $this->actingAs($user)->get(route('my'));

        $response->assertSee("My galleries");
        $response->assertSee("Here are all the galleries you published on Galeriz.");
    }

    public function test_display_a_message_when_no_galleries_exists()
    {
        $user = User::factory()->create();  //new user without gallery

        $response = $this->actingAs($user)->get(route('my'));

        $response->assertSee("No gallery for the moment...");
    }
}
