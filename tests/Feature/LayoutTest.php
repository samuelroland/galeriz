<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_layout_menu_is_correct_when_unlogged()
    {
        $response = $this->get(route('panorama'));

        $response->assertSee("Panorama");
        $response->assertDontSeeText("My galleries");
        $response->assertDontSeeText("Followed galleries");
        $response->assertDontSeeText("New gallery");
        $response->assertDontSeeText("My profile");
        $response->assertDontSeeText("Settings");
    }

    public function test_layout_menu_is_correct_when_user_is_logged()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('panorama'));

        $response->assertSeeText("Panorama");
        $response->assertSeeText("My galleries");
        $response->assertSeeText("Followed galleries");
        $response->assertSeeText("New gallery");
        $response->assertSeeText("My profile");
        $response->assertSeeText("Settings");
    }
}