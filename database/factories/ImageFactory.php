<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ImageFactory extends Factory
{
    use WithFaker, RefreshDatabase;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(rand(5, 100))
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Image $image) {
            Storage::disk('local')->delete($image->path);  //delete just in case it already exists
            Storage::copy('fake-image.png', $image->path);
        });
    }
}
