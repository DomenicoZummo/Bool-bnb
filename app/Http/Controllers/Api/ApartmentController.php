<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\User;

class ApartmentController extends Controller
{
    //

    // public function index(Request $request)
    // {

    //     $query = $request->query();

    //     $lat = $query['lat'];
    //     $lng = $query['lng'];
    //     $range = $query['range'];


    //     $apartment_filter = Apartment::whereBetween('latitude', [($lat - $range / 100), ($lat + $range / 100)])
    //         ->whereBetween('longitude', [[($lng - $range / 100), ($lng + $range / 100)]])->with('user', 'services', 'sponsorships')->get();



    //     if ($apartment_filter) {
    //         foreach ($apartment_filter as  $apartment) {
    //             $apartment['img_path'] = url('storage/' .   $apartment['img_path']);
    //         }
    //     }


    //     return response()->json($apartment_filter);
    // }

    // // Get blog's post detail by slug
    // public function show($slug)
    // {
    //     $apartment = Apartment::where('slug', $slug)->with(['services'])->first();

    //     if ($apartment->img_path) {
    //         $apartment->img_path = url('storage/' . $apartment->img_path);
    //     }

    //     return response()->json($apartment);
    // }
}
