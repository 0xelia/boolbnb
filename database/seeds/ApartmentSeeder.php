<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i <= 15; $i++){
            $a = new Apartment;
            $a->title = $faker->words(rand(3, 8), true);
            $a->rooms_number = rand(2, 6);
            $a->beds_number = rand(2, 6);
            $a->baths_number = rand(2, 6);
            $a->meters = rand(70, 300);
            $a->address = $faker->streetAddress();
            $a->latitude = $faker->latitude();
            $a->longitude = $faker->longitude();
            $a->image = $faker->imageUrl();

            $a->save();
        }
    }
}
