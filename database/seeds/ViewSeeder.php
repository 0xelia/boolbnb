<?php

use App\View;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 15; $i++) {
            $v = new View();
            $v->path = $faker->ipv4();
            $v->date = $faker->date();

            $v->save();
        }
    }
}
