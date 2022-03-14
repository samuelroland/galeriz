<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true; //seed the database at each run

    //Gallery pages tests
    public function test_galleries_page_exists()
    {
        $response = $this->get(route('panorama'));

        $response->assertStatus(200);
    }

    public function test_gallery_details_page_without_id_redirects_to_panorama()
    {
        $this->get('/galleries')->assertRedirect(route('panorama'));
    }

    public function test_my_galleries_page_exists()
    {
        $author = User::first();

        $this->actingAs($author)->get(route('my'))->assertStatus(200);
    }

    public function test_gallery_details_page_exists()
    {
        $this->get(route('gallery', ['gallery' => Gallery::all()->random()->id]))->assertStatus(200);
    }

    public function test_create_a_gallery_page_exists()
    {
        $this->actingAs(User::first())->get(route('galleries.new'))->assertStatus(200);
    }

    //All galleries tests (Panorama page)
    public function test_all_galleries_are_visible()
    {
        $galleries = Gallery::all();

        $visitor = $this->get(route('panorama'));

        $visitor->assertSeeText($galleries->pluck('title')->toArray());
        $visitor->assertDontSeeText($galleries->pluck('description')->toArray());
    }

    public function test_all_cover_images_are_displayed()
    {
        $galleries = Gallery::all();
        $visitor = $this->get(route('panorama'));

        $galleries->where('cover_id', '!=', null)->each(
            function ($gallery) use ($visitor) {
                $visitor->assertSee($gallery->cover->path);
            }
        );
    }

    // public function test_galleries_have_a_default_cover()
    // {
    //     $galleries = Gallery::all();
    //     $visitor = $this->get(route('panorama'));
    //     $this->assertEquals($galleries->where('cover_id', null)->count(), substr_count("gallery-cover.//png", $visitor->getContent()));
    // }


    //Gallery details tests
    public function test_gallery_details_page_is_displayed()
    {
        $user = User::factory()->create();
        $gallery = Gallery::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('gallery', ['gallery' => $gallery->id]));

        $response->assertSeeText([$gallery->title, $gallery->description, $gallery->author->name]);

        //todo: gallery cover
    }

    public function test_gallery_details_page_display_all_images()
    {
        $gallery = Gallery::first();
        $visitor = $this->get(route('gallery', ['gallery' => $gallery->id]));

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

        $response = $this->get(route('gallery', ['gallery' => $gallery->id]));

        $response->assertSee("image-not-found.png");
    }

    public function test_an_image_with_empty_path_has_default_not_found_image()
    {
        $gallery = Gallery::factory()->create(['user_id' => User::first()->id]);
        $image = Image::factory()->create(['gallery_id' => $gallery->id]);
        $image->path = "";
        $image->save();

        $response = $this->get(route('gallery', ['gallery' => $gallery->id]));

        $response->assertSee("image-not-found.png");
    }

    //Tests for Create a gallery page
    public function test_gallery_creation_is_guarded()
    {
        $data = [
            'title' => 'Great gallery',
            'description' => 'A great gallery about my holidays.'
        ];

        $response = $this->post(route('galleries.new'), $data);
        $response->assertStatus(302);
        $response = $this->get(route('galleries.new'));
        $response->assertStatus(302);
    }

    public function test_gallery_creation_endpoint_creates_a_gallery()
    {
        $author = User::factory()->create();

        $data = [
            'title' => 'Great gallery',
            'description' => 'A great gallery about my holidays.'
        ];

        $response = $this->actingAs($author)->post(route('galleries.new'), $data);

        $this->assertDatabaseHas('galleries', $data);
        $response->assertRedirect(route('gallery', ['gallery' => $author->galleries()->first()->id]));
    }

    //Test for My galleries page
    public function test_my_galleries_page_is_guarded()
    {
        $this->get(route('my'))->assertStatus(302);
    }

    public function test_my_galleries_are_all_displayed()
    {
        $user = User::first();
        $galleries = $user->galleries;

        $response = $this->actingAs($user)->get(route('my'));

        $this->assertEquals(substr_count($response->getContent(), 'single-gallery'), $galleries->count());
    }
}
