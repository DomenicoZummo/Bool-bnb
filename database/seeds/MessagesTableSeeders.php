<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;

class MessagesTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        for ($i=0; $i < 10; $i++) { 
           
            $new_message = new Message();

            $apartment = Apartment::inRandomOrder()->first(); // Selezione di uno apartment casuale

            $new_message->apartment_id = $apartment->id;

            $new_message->name = $faker->firstName();
            $new_message->surname = $faker->lastName();
            $new_message->email = $faker->unique()->email;
            $new_message->message = $faker->paragraph(3, true);

            $new_message->save();

        }

    }
}
