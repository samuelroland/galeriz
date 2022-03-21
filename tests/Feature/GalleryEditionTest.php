<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryEditionTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true; //seed the database at each run

    public function test_gallery_edition_page_exists()
    {
        $author = User::first();
        $gallery = $author->galleries()->first();

        $response = $this->actingAs($author)->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertStatus(200);
    }

    public function test_gallery_edition_page_is_guarded()
    {
        $gallery = User::first()->galleries()->first();

        $response = $this->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertRedirect(route('login'));
    }

    public function test_gallery_edition_page_redirects_to_gallery_details_page_if_user_doesnt_own_the_gallery()
    {
        $author = User::first();
        $gallery = $author->galleries()->first();
        $anotherAuthor = User::whereEmail('sam@sam.com')->first();

        $response = $this->actingAs($anotherAuthor)->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertRedirect(route('galleries.show', ['gallery' => $gallery->id]));
    }

    public function test_edit_button_is_visible_only_if_user_own_the_gallery()
    {
        $author = User::all()->first();
        $gallery = $author->galleries()->first();
        $anotherAuthor = User::whereEmail('sam@sam.com')->first();

        $response = $this->actingAs($anotherAuthor)->get(route('galleries.show', ['gallery' => $gallery->id]));

        $response->assertDontSee("Edit gallery");
    }

    public function test_gallery_title_can_be_edited()
    {
        //TODO
    }

    public function test_gallery_description_can_be_edited()
    {
        //TODO
    }
}