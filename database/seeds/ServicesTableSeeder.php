<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = [
            'Wi-fi',
            'Posto macchina',
            'Piscina',
            'Animali',
            'Vista mare',
            'Sauna',
            'Portineria',
            'Cucina',
            'Possibilità di fumare',
            'Ascensore',
            'Cassaforte',
            'Tv',
            'Aria condizionata',
            'Kit di pronto-soccorso',
            'Lavatrice'

        ];

        foreach ($services as $service) {
            
            $new_service = new Service();

            $new_service->name = $service;

            $new_service->save();

        }
    }
}
