<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\User;

class ApartmentController extends Controller
{
    //

    public function index(Request $request)
    {

        $query = $request->query();

        $minlat = $query['lat'];
        $minlng = $query['lng'];
        $range = $query['range'] / 100;




        $apartment_filter = Apartment::whereRaw('(latitude >= ' . ($minlat - $range) .  ' and latitude <= ' . ($minlat + $range) .') && (longitude >= ' . ($minlng - $range) . ' and longitude <= ' . ($minlng + $range) . ')', array(25))->with('user', 'services' , 'sponsorships')->get();

        //  $apartments = Apartment::with('user', 'services' , 'sponsorships')->get();

        if($apartment_filter){
            foreach ($apartment_filter as  $apartment) {
                $apartment['img_path'] = url('storage/'.   $apartment['img_path']);
            }
            
         }

        
        return response()->json( $apartment_filter);

    }


}
