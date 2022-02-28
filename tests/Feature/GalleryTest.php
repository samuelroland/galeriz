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

        $galleries->each(
            function ($gallery) use ($visitor) {
                $visitor->assertSee($gallery->title);
                $visitor->assertDontSee($gallery->description);
            }
        );
    }

    public function test_all_cover_images_are_displayed_and_exist()
    {
        $galleries = Gallery::all();
        $visitor = $this->get('/galleries');

        $galleries->where('cover_id', '!=', null)->each(
            function ($gallery) use ($visitor) {

                $visitor->assertSee($gallery->cover->path);
                $this->assertFileExists(base_path('storage/app') . "/" . $gallery->cover->path);
            }
        );
    }
}
