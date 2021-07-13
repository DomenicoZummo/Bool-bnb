<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\User;

class ApartmentController extends Controller
{
    //

    public function index()
    {
        $apartments = Apartment::with('user', 'services' , 'sponsorships')->get();
        return response()->json( $apartments);

    }

}
