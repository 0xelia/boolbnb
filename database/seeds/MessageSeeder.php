<?php

use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $message = new Message();
            $message->text = $faker->paragraphs(rand(10, 20), true);
            $message->email = $faker->email();
            $message->name = $faker->firstName();
            $message->surname = $faker->lastName();

            $message->save();
        }
    }
}
