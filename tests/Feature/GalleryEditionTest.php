<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use Livewire\Livewire;
use App\Models\Gallery;
use Illuminate\Support\Str;
use App\Http\Livewire\GalleryDetails;
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

    public function test_edit_button_is_not_visible_when_the_gallery_author_is_not_the_user_logged()
    {
        $author = User::all()->first();
        $gallery = $author->galleries()->first();
        $anotherAuthor = User::whereEmail('sam@sam.com')->first();

        $response = $this->actingAs($anotherAuthor)->get(route('galleries.show', ['gallery' => $gallery->id]));

        $response->assertDontSee("Edit gallery");
    }

    public function test_livewire_edition_component_are_present_on_page()
    {
        $gallery = Gallery::first();

        $response = $this->actingAs($gallery->author)->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertSeeLivewire('gallery-details');
    }

    public function test_gallery_title_can_be_edited()
    {
        $gallery = Gallery::first();
        $this->actingAs($gallery->author);

        $tester = Livewire::test(GalleryDetails::class, ['gallery' => $gallery])
            ->set('gallery.title', "great title")
            ->call('save');

        $tester->assertSee("great title")->assertDontSee($gallery->title);
        $this->assertTrue(Gallery::whereTitle('great title')->exists());
    }

    public function test_gallery_description_can_be_edited()
    {
        $gallery = Gallery::first();
        $this->actingAs($gallery->author);

        Livewire::test(GalleryDetails::class, ['gallery' => $gallery])
            ->set('gallery.description', "great description")
            ->call('save');

        $this->assertTrue(Gallery::whereDescription('great description')->exists());
    }

    public function test_title_and_description_must_be_valid()
    {
        $gallery = Gallery::first();
        $this->actingAs($gallery->author);

        Livewire::test(GalleryDetails::class, ['gallery' => $gallery])
            ->set('gallery.description', "   ")
            ->set('gallery.title', "")
            ->call('save')
            ->assertHasErrors(['gallery.title', 'gallery.description']);

        Livewire::test(GalleryDetails::class, ['gallery' => $gallery])
            ->set('gallery.description', Str::random(1100))
            ->set('gallery.title', Str::random(40))
            ->call('save')
            ->assertHasErrors(['gallery.title', 'gallery.description']);
    }
}