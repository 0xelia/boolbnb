<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Apartment;
use App\User;
use App\Service;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::all()->pluck('id');
        $services = Service::all();

        for($i = 0; $i <= 15; $i++){
            $a = new Apartment;
            $a->title = $faker->words(rand(3, 8), true);
            $a->user_id = $faker->randomElement($user_ids);
            $a->rooms_number = rand(2, 6);
            $a->beds_number = rand(2, 6);
            $a->bath_number = rand(2, 6);
            $a->meters = rand(70, 300);
            $a->address = $faker->streetAddress();
            $a->latitude = $faker->latitude();
            $a->longitude = $faker->longitude();
            $a->image = $faker->imageUrl();
            $a->price = rand(20, 400);

            $a->save();

            $random_services = $services->shuffle()->take(3);
            $a->services()->sync($random_services);

        }
    }
}
