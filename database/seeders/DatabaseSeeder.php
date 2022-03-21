<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Gallery;
use App\Models\GalleryUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //Create 3 users + 1 fixed user "Sam"
        $users = User::factory(3)->create();
        $users->push(User::factory()->create(['name' => "Sam", 'email' => 'sam@sam.com', 'password' => bcrypt('password')]));   //add special fixed user for testing

        //Create 7 galleries linked to an existing user
        $galleries = Gallery::factory(7)->create(fn () => ['user_id' => $users->random()->id]);    //Create 7 galleries made by a random user
        $galleries = Gallery::factory(7)->create(fn () => ['user_id' => $users->first()]);    //Make sure the first user has at least 2 galleries (for testing)

        //Create 15 images linked to an existing category
        $images = Image::factory(15)->create(fn () => ['gallery_id' => $galleries->random()->id]);

        //Add cover images for a part of the galleries (4/5) with a random image contained in the gallery
        $galleries->each(function (Gallery $gallery) {
            if (rand(1, 5) < 5) {
                if ($gallery->images->count() != 0) { //make sure there are images inside before choosing a cover
                    $gallery->cover_id = $gallery->images->random()->id;
                    $gallery->save();
                }
            }
        });

        //Add gallery_user records (users following galleries)
        GalleryUser::factory(12)->create(fn () => ['user_id' => $users->random()->id, 'gallery_id' => $galleries->random()->id]);
    }
}