<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;

class SponsorshipsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sponsorships = [
            
            'pack1' => [
                      'name' => 'silver',
                      'durations' => 24,
                      'price' => 2.99,
            ],
            'pack2' => [
                      'name' => 'gold',
                      'durations' => 72,
                      'price' => 5.99,
            ],
            'pack3' => [
                      'name' => 'platinum',
                      'durations' => 144,
                      'price' => 9.99,
            ],

        ];



        foreach ($sponsorships as $sponsorship) {
            
            $new_sponsorship = new Sponsorship();

            $new_sponsorship->type = $sponsorship['name'];
            $new_sponsorship->duration = $sponsorship['durations'];
            $new_sponsorship->price = $sponsorship['price'];


            $new_sponsorship->save();

        }

    }
}
