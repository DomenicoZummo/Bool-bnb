<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SponsorshipsApartments extends Controller
{
    public function index(){

        $apartments =  Apartment::with('sponsorships','services')->get();

        $apartments_sponsored = [];

        foreach ($apartments  as  $apartment) {
        $count = $apartment->sponsorships;
        if(count($count) > 0){
            $apartments_sponsored[] = $apartment;
        }
        }

        if ($apartments_sponsored) {
            foreach ($apartments_sponsored as  $apartment) {

                //  dd($apartment['attributes']->id);
                $apartment->img_path = url('storage/' .   $apartment['img_path']);
            }
        }

        return response()->json( $apartments_sponsored);

    }
}
