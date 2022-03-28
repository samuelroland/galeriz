<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use Livewire\Livewire;
use App\Models\Gallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_image_can_be_uploaded()
    {
        $gallery = Gallery::first();
        $user = $gallery->author;
        Storage::fake('public');
        $file = UploadedFile::fake()->image('nice picture.png');

        Livewire::actingAs($user)
            ->test('upload-image')
            ->set('gallery', $gallery)
            ->set('image', $file)
            ->set('title', 'My holiday')
            ->call('save');

        $createdImage = Image::whereTitle('My holiday')->first();
        $this->assertNotNull($createdImage);
        Storage::disk('public')->assertExists($createdImage->path);
    }
}
