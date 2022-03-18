<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllGalleriesTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true; //seed the database at each run

    //Gallery pages tests
    public function test_galleries_page_exists()
    {
        $response = $this->get(route('galleries.index'));

        $response->assertStatus(200);
    }


    //All galleries tests (Panorama page)
    public function test_all_galleries_are_visible()
    {
        $galleries = Gallery::all();

        $visitor = $this->get(route('galleries.index'));

        $visitor->assertSeeText($galleries->pluck('title')->toArray());
        $visitor->assertDontSeeText($galleries->pluck('description')->toArray());
    }

    public function test_all_cover_images_are_displayed()
    {
        $galleries = Gallery::all();
        $visitor = $this->get(route('galleries.index'));

        $galleries->where('cover_id', '!=', null)->each(
            function ($gallery) use ($visitor) {
                $visitor->assertSee($gallery->cover->path);
            }
        );
    }

    // public function test_galleries_have_a_default_cover()
    // {
    //     $galleries = Gallery::all();
    //     $visitor = $this->get(route('galleries.index'));
    //     $this->assertEquals($galleries->where('cover_id', null)->count(), substr_count("gallery-cover.//png", $visitor->getContent()));
    // }

}
