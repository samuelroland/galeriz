<?php

namespace Database\Seeders;

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

        $galleries = Gallery::factory(30)->create(fn () => ['user_id' => $users->random()->id]);    //Create 30 galleries made by a random user

        $images = Image::factory(200)->create(fn () => ['gallery_id' => $galleries->random()->id]);
    }
}
