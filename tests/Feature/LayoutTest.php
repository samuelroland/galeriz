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
        $response->assertDontSee("My galleries");
        $response->assertDontSee("Followed galleries");
    }

    public function test_layout_menu_is_correct_when_user_is_logged()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('panorama'));

        $response->assertSee("Panorama");
        $response->assertSee("My galleries");
        $response->assertSee("Followed galleries");
    }
}
