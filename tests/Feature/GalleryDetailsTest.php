<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
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

        $response = $this->get(route('galleries.show', ['gallery' => $gallery->id]));

        $response->assertSeeText([$gallery->title, $gallery->description, $gallery->author->name]);

        //todo: gallery cover
    }

    public function test_gallery_details_page_display_all_images()
    {
        $gallery = Gallery::first();
        $visitor = $this->get(route('galleries.show', ['gallery' => $gallery->id]));

        $gallery->images->each(
            function ($image) use ($visitor) {
                $visitor->assertSee($image->path);
                $visitor->assertSee($image->title);
            }
        );
    }

    public function test_an_image_without_file_on_disk_has_default_not_found_image()
    {
        $gallery = Gallery::factory()->create(['user_id' => User::first()->id]);
        $image = Image::factory()->create(['gallery_id' => $gallery->id]);
        $image->path = "wrong path";
        $image->save();

        $response = $this->get(route('galleries.show', ['gallery' => $gallery->id]));

        $response->assertSee("image-not-found.png");
    }

    public function test_an_image_with_empty_path_has_default_not_found_image()
    {
        $gallery = Gallery::factory()->create(['user_id' => User::first()->id]);
        $image = Image::factory()->create(['gallery_id' => $gallery->id]);
        $image->path = "";
        $image->save();

        $response = $this->get(route('galleries.show', ['gallery' => $gallery->id]));

        $response->assertSee("image-not-found.png");
    }
}
