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


        $apartment_filter = Apartment::whereRaw('(latitude >= ' . ($minlat - 0.1) .  ' and latitude <= ' . ($minlat + 0.1) .') && (longitude >= ' . ($minlng - 0.1) . ' and longitude <= ' . ($minlng + 0.1) . ')', array(25))->with('user', 'services' , 'sponsorships')->get();

        //  $apartments = Apartment::with('user', 'services' , 'sponsorships')->get();

        if($apartment_filter){
            foreach ($apartment_filter as  $apartment) {
                $apartment['img_path'] = url('storage/'.   $apartment['img_path']);
            }
            
         }

        
        return response()->json( $apartment_filter);

    }


}
