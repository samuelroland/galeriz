<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();

        //Create 30 galleries linked to an existing user
        $galleries = Gallery::factory(30)->create(fn () => ['user_id' => $users->random()->id]);    //Create 30 galleries made by a random user

        //Create 200 images linked to an existing category
        $images = Image::factory(200)->create(fn () => ['gallery_id' => $galleries->random()->id]);

        //Add cover images for a part of the galleries (4/5) with a random image contained in the gallery
        $galleries->each(function (Gallery $gallery) {
            if (rand(1, 5) < 5) {
                $gallery->cover_id = $gallery->images->random()->id;
                $gallery->save();
            }
        });
    }
}
