<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryDetailsTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true; //seed the database at each run

    public function test_gallery_details_page_without_id_redirects_to_panorama()
    {
        $this->get('/galleries')->assertRedirect(route('galleries.index'));
    }

    public function test_gallery_details_page_exists()
    {
        $this->get(route('galleries.show', ['gallery' => Gallery::all()->random()->id]))->assertStatus(200);
    }


    //Gallery details tests
    public function test_gallery_details_page_is_displayed()
    {
        $user = User::factory()->create();
        $gallery = Gallery::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('galleries.show', $gallery));

        $response->assertSeeText([$gallery->title, $gallery->description, $gallery->author->name]);
    }

    public function test_gallery_details_page_display_all_images()
    {
        $gallery = Gallery::factory()->create(['user_id' => User::first()->id]);
        $images = Image::factory(3)->create(['gallery_id' => $gallery->id]);
        $visitor = $this->get(route('galleries.show', $gallery));

        $gallery->images->each(
            function ($image) use ($visitor) {
                $visitor->assertSee($image->path);
                $visitor->assertSee($image->title);
            }
        );
    }

    public function test_a_message_is_displayed_when_there_is_no_image()
    {
        $gallery = Gallery::factory()->create(['user_id' => User::first()->id]);
        $response = $this->get(route('galleries.show', $gallery));

        $response->assertSee("There is no image in this gallery...");
    }
}
