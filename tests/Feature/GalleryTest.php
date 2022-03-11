<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_galleries_page_exists()
    {
        $response = $this->get(route('panorama'));

        $response->assertStatus(200);
    }

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

    public function test_gallery_details_page_without_id_redirects_to_panorama()
    {
        $this->get('/galleries')->assertRedirect(route('panorama'));
    }

    public function test_my_galleries_page_exists()
    {
        $this->get(route('my'))->assertStatus(200);
    }

    public function test_gallery_details_page_exists()
    {
        $this->get(route('gallery', ['id' => 1]))->assertStatus(200);
    }
}
