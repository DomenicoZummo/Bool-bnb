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

        $minlat = $query['minlat'];

        $maxlat = $query['maxlat'];

        $minlng = $query['minlng'];

        $maxlng = $query['maxlng'];

       


        $apartment_filter = Apartment::whereRaw('(latitude >= ' .$minlat.  ' and latitude <= ' . $maxlat .') && (longitude >= ' . $minlng . ' and longitude <= ' . $maxlng . ')', array(25))->with('user', 'services' , 'sponsorships')->get();

         $apartments = Apartment::with('user', 'services' , 'sponsorships')->get();

        return response()->json( $apartment_filter);

    }

}
