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
        $apartments = config('apartments');
        $user_ids = User::all()->pluck('id');
        $services = Service::all();

        foreach ($apartments as $apartment) {
            $a = new Apartment;
            
            $a->title = $apartment['title'];
            $a->user_id = $faker->randomElement($user_ids);
            $a->rooms_number = $apartment['rooms_number'];
            $a->beds_number = $apartment['beds_number'];
            $a->bath_number = $apartment['bath_number'];
            $a->meters = $apartment['meters'];
            $a->address = $apartment['address'];
            $a->latitude = $apartment['latitude'];
            $a->longitude = $apartment['longitude'];
            $a->image = $apartment['image'];
            $a->price = $apartment['price'];
            
            $a->save();
    
        }

        $random_services = $services->shuffle()->take(3);
        $a->services()->sync($random_services);
    }
}
