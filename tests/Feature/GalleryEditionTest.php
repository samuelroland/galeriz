<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use Livewire\Livewire;
use App\Models\Gallery;
use Illuminate\Support\Str;
use App\Http\Livewire\ImageGrid;
use App\Http\Livewire\GalleryDetailsUpdate;
use Illuminate\Support\Facades\Storage;
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

    public function test_it_redirects_to_gallery_details_if_user_is_not_the_gallery_owner()
    {
        $author = User::first();
        $gallery = $author->galleries()->first();
        $anotherAuthor = User::whereEmail('sam@sam.com')->first();

        $response = $this->actingAs($anotherAuthor)->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertRedirect(route('galleries.show', ['gallery' => $gallery->id]));
    }

    public function test_edit_button_is_not_visible_if_user_is_not_the_gallery_owner()
    {
        $author = User::all()->first();
        $gallery = $author->galleries()->first();
        $anotherAuthor = User::whereEmail('sam@sam.com')->first();

        $response = $this->actingAs($anotherAuthor)->get(route('galleries.show', ['gallery' => $gallery->id]));

        $response->assertDontSee("Edit gallery");
    }

    public function test_livewire_gallery_edition_components_are_present_on_page()
    {
        $gallery = Gallery::first();

        $response = $this->actingAs($gallery->author)->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertSeeLivewire('gallery-details-update');
        $response->assertSeeLivewire('image-grid');
    }


    public function test_gallery_title_can_be_edited()
    {
        $gallery = Gallery::first();
        $this->actingAs($gallery->author);

        $tester = Livewire::test(GalleryDetailsUpdate::class, ['gallery' => $gallery])
            ->set('gallery.title', "great title")
            ->call('save');

        $this->assertTrue(Gallery::whereTitle('great title')->exists());
    }

    public function test_gallery_description_can_be_edited()
    {
        $gallery = Gallery::first();
        $this->actingAs($gallery->author);

        Livewire::test(GalleryDetailsUpdate::class, ['gallery' => $gallery])
            ->set('gallery.description', "great description")
            ->call('save');

        $this->assertTrue(Gallery::whereDescription('great description')->exists());
    }

    public function test_title_and_description_must_be_valid()
    {
        $gallery = Gallery::first();
        $this->actingAs($gallery->author);

        Livewire::test(GalleryDetailsUpdate::class, ['gallery' => $gallery])
            ->set('gallery.description', "   ")
            ->set('gallery.title', "")
            ->call('save')
            ->assertHasErrors(['gallery.title', 'gallery.description']);

        Livewire::test(GalleryDetailsUpdate::class, ['gallery' => $gallery])
            ->set('gallery.description', Str::random(1100))
            ->set('gallery.title', Str::random(40))
            ->call('save')
            ->assertHasErrors(['gallery.title', 'gallery.description']);
    }

    public function test_a_message_is_displayed_when_there_is_no_image()
    {
        $author = User::first();
        $gallery = Gallery::factory()->create(['user_id' => $author->id]);
        $response = $this->actingAs($author)->get(route('galleries.update', ['gallery' => $gallery->id]));

        $response->assertSee("There is no image in this gallery...");
    }

    public function test_image_deletion_deletes_in_db_and_on_disk()
    {
        $image = Image::first();
        $gallery = $image->gallery;
        $this->actingAs($gallery->author);
        $path = $image->path;
        Livewire::test(ImageGrid::class, ['gallery' => $gallery])
            ->call('delete', $image->id);

        $this->assertModelMissing($image);
        $this->assertFalse(Storage::disk('local')->exists($path));
    }

    public function test_image_is_not_deleted_if_is_not_in_the_current_gallery()
    {
        //Context: the user is the author of the gallery, but the image id given refers to an image outside of this gallery
        $image = Image::factory()->create(['gallery_id' => Gallery::first()->id]);
        $gallery = Gallery::factory()->create(['user_id' => User::first()->id]);
        $this->actingAs($gallery->author);

        Livewire::test(ImageGrid::class, ['gallery' => $gallery])
            ->call('delete', $image->id);

        $this->assertModelExists($image);   //make sure it was not deleted
    }

    public function test_image_is_not_deleted_if_author_is_not_the_gallery_owner()
    {
        //Context: the user is NOT the author of the gallery. The image is in the current gallery.
        $gallery = Gallery::factory()->create(['user_id' => User::find(1)->id]);
        $image = Image::factory()->create(['gallery_id' => $gallery->id]);
        $this->actingAs(User::find(2));

        Livewire::test(ImageGrid::class, ['gallery' => $gallery])
            ->call('delete', $image->id);

        $this->assertModelExists($image);   //make sure it was not deleted
    }

    public function test_cover_image_is_set_to_null_if_deleted_image_is_the_cover()
    {
        $image = Image::first();
        $gallery = $image->gallery;
        $gallery->cover_id = $image->id;
        $gallery->save();
        $this->actingAs($gallery->author);

        Livewire::test(ImageGrid::class, ['gallery' => $gallery])
            ->call('delete', $image->id);

        $gallery->refresh();    //to get the new value of cover_id
        $this->assertNull($gallery->cover_id);
    }
}
