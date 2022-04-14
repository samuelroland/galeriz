<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryCreationTest extends TestCase
{
    use RefreshDatabase;



    public function test_create_a_gallery_page_exists()
    {
        $this->actingAs(User::first())->get(route('galleries.create'))->assertStatus(200);
    }

    public function test_gallery_creation_is_guarded()
    {
        $data = [
            'title' => 'Great gallery',
            'description' => 'A great gallery about my holidays.'
        ];
        $response = $this->post(route('galleries.store'), $data);
        $response->assertRedirect(route('login'));
        $response = $this->get(route('galleries.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_gallery_creation_creates_a_gallery_with_logged_user()
    {
        $author = User::factory()->create();
        $data = [
            'title' => 'Great gallery',
            'description' => 'A great gallery about my holidays.'
        ];
        $response = $this->actingAs($author)->post(route('galleries.store'), $data);
        $this->assertDatabaseHas('galleries', $data);
        $response->assertRedirect(route('galleries.show', ['gallery' => $author->galleries()->first()->id]));
        $this->assertEquals($author->galleries()->first()->user_id, $author->id);
    }

    public function test_gallery_creation_validates_data()
    {
        $author = User::factory()->create();
        //Values must be required (and not empty when trimmed)
        $data = [
            'title' => '  ',
            'description' => ''
        ];
        $response = $this->actingAs($author)->post(route('galleries.store'), $data);
        $response->assertSessionHasErrors(['description', 'title']);
        //Values length must be checked
        $data = [
            'title' => Str::random(40),
            'description' => Str::random(1100)
        ];
        $response = $this->actingAs($author)->post(route('galleries.store'), $data);
        $response->assertSessionHasErrors(['description', 'title']);
    }
}
