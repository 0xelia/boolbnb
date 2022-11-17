<?php

use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = config('sponsor');

        foreach($plans as $plane) {
            $p = new Sponsor();
            $p->plane = $plane['plane'];
            $p->price = $plane['price'];
            $p->duration = $plane['duration'];

            $p->save();
        }

    }
}
