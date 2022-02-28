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
            "path" => $this->faker->unique()->randomNumber(5),    //temporary unique value before overwriting in the configure()
            'title' => $this->faker->text(rand(5, 100))
        ];
    }

    public function configure()
    {
        //After the creation we have the id and we can overwrite the path like "images/3.png" and create the file on the disk
        return $this->afterCreating(function (Image $image) {
            $image->path = "images/" . $image->id . ".png";
            Storage::delete($image->path);  //delete in case it exists
            Storage::copy('fake-image.png', $image->path);
            $image->save();
        });
    }
}
