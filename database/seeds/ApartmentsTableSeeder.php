<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Apartment;
use App\User;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Creazione dati fake

        for ($i=0; $i < 10 ; $i++) { 
            
            $new_apartment = new Apartment();
            
            $user = User::inRandomOrder()->first(); // Selezione di uno user casuale

            $new_apartment->user_id = $user->id;

            $new_apartment->title = $faker->sentence(6, true);

            $new_apartment->slug = Str::slug($new_apartment->title,'-');

            $new_apartment->address = $faker->address();

            $new_apartment->latitude = $faker->latitude($min = -90, $max = 90);

            $new_apartment->longitude = $faker->longitude($min = -180, $max = 180);

            $new_apartment->description = $faker->paragraph(3, true);

            $new_apartment->floor = $faker->randomDigitNotNull();

            $new_apartment->rooms = $faker->randomDigitNotNull();

            $new_apartment->beds = $faker->randomDigitNotNull();

            $new_apartment->bathrooms = $faker->randomDigitNotNull();

            $new_apartment->square_meters = $faker->numberBetween(50,300 );

            $new_apartment->img_path = 'https://picsum.photos/200/300';

            $new_apartment->visibility = 1;


            $new_apartment->save();
           

        }
    }
}
