<?php

use App\Image;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 15; $i++) {
            $image = new Image();
            $image->path = $faker->imageUrl(640, 480, 'animals', true);

            $image->save();
        }
    }
}
