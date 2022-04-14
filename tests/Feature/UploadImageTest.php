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
        Storage::fake('local');
        $file = UploadedFile::fake()->image('nice picture.png');

        Livewire::actingAs($user)
            ->test('upload-image')
            ->set('gallery', $gallery)
            ->set('image', $file)
            ->set('title', 'My holiday')
            ->call('save');

        $createdImage = Image::whereTitle('My holiday')->first();
        $this->assertNotNull($createdImage);
        Storage::disk('local')->assertExists($createdImage->path);
    }

    public function test_title_and_image_are_validated()
    {
        $gallery = Gallery::first();
        $user = $gallery->author;
        Storage::fake('local');

        //Too long title and too big image
        $file = UploadedFile::fake()->image('nice picture.png')->size(11000);

        $response = Livewire::actingAs($user)
            ->test('upload-image')
            ->set('gallery', $gallery)
            ->set('image', $file)
            ->set('title', 'Too much long TTIIIIIIITTTTTLE')
            ->call('save');

        $createdImage = Image::whereTitle('Too much long TTIIIIIIITTTTTLE')->first();
        $this->assertNull($createdImage);
        $response->assertHasErrors(['image', 'title']);

        //Image in PDF
        $file = UploadedFile::fake()->create('nice_document.pdf');
        $response = Livewire::actingAs($user)
            ->test('upload-image')
            ->set('gallery', $gallery)
            ->set('image', $file)
            ->set('title', 'valid title')
            ->call('save');

        $createdImage = Image::whereTitle('valid title')->first();
        $this->assertNull($createdImage);
        $response->assertHasErrors(['image']);

        //Empty fields
        $file = UploadedFile::fake()->create('nice_document.pdf');
        $response = Livewire::actingAs($user)
            ->test('upload-image')
            ->set('gallery', $gallery)
            ->call('save');

        $response->assertHasErrors(['image', 'title']);
    }
}
