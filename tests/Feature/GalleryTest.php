<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryTest extends TestCase
{
    public function test_galleries_page_exists()
    {
        $response = $this->get('/galleries');

        $response->assertStatus(200);
    }

    public function test_all_galleries_are_visible()
    {
        $galleries = Gallery::all();

        $visitor = $this->get('/galleries');

        $visitor->assertSeeText($galleries->pluck('title')->toArray());
        $visitor->assertDontSeeText($galleries->pluck('description')->toArray());
    }

    public function test_all_cover_images_are_displayed_and_exist()
    {
        $galleries = Gallery::all();
        $visitor = $this->get('/galleries');

        $galleries->where('cover_id', '!=', null)->each(
            function ($gallery) use ($visitor) {
                $visitor->assertSee($gallery->cover->path);
                $this->assertFileExists(base_path('storage/app/public') . "/" . $gallery->cover->path);
                //  $this->get("storage/" . $gallery->cover->path)->assertStatus(200);
            }
        );
    }

    // public function test_galleries_have_a_default_cover()
    // {
    //     $galleries = Gallery::all();
    //     $visitor = $this->get('/galleries');
    //     $this->assertEquals($galleries->where('cover_id', null)->count(), substr_count("gallery-cover.//png", $visitor->getContent()));
    // }
}
