<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Apartment;

class AdvancedSearchController extends Controller
{

    public function index(Request $request)
    {

        $query = $request->query();

        $address = $query['address'];

        $lat = $query['lat'];
        $lng = $query['lng'];
        $range = $query['range'];

        // dd($range); 

        $rooms = $query['rooms'];
        $beds = $query['beds'];
        $services = $query['services'];

        $listIntServices = [];

        // dd($listIntServices);
        $apartment_filter = Apartment::whereBetween('latitude', [($lat - $range / 100), ($lat + $range / 100)])
            ->whereBetween('longitude', [[($lng - $range / 100), ($lng + $range / 100)]])
            ->where('rooms', '>=',  $rooms)
            ->where('beds', '>=',  $beds)
            ->with('user', 'services', 'sponsorships')
            ->get();

        // $distances=[];

        // foreach($apartment_filter as $coordinate){
        //     $coordLat = $coordinate->latitude;
        //     $coordLng = $coordinate->longitude;
        //     $distance = sqrt(($coordLat - $lat)*($coordLat - $lat) + ($coordLng - $lng)*($coordLng - $lng) );
        //      $distances[] = $distance;
        //     
        // };

        // sort($distances);
        // dd($distances);




        $serviceApartment = [];
        $apartment_service_filter = [];





        if ($services != null) {
            $listServices = explode(',', $services);

            foreach ($listServices as $servic) {
                $intServ = intval($servic);
                $listIntServices[] = $intServ;
            }
            sort($listIntServices);

            // dd($listIntServices);

            if (count($listIntServices) >= 1) {



                foreach ($apartment_filter as $apartment) {


                    $service_apartment = $apartment->services;


                    // dd($apartment->services);
                    if (count($service_apartment) >= 1) {

                        foreach ($service_apartment as $service) {

                            // dd($listIntServices);
                            // dd($service['id']);


                            foreach ($listIntServices as $idfilter) {
                                // dd($idfilter);
                                if ($service['id'] == $idfilter) {

                                    $apartment_service_filter[] = $apartment;
                                }
                            }
                            // dump($serviceApartment);

                            // array_diff($serviceApartment,$listIntServices );
                            // dd(array_diff($serviceApartment,$listIntServices ));
                        }
                    }
                }
            }

            // dd(array_unique($apartment_service_filter));

            $apartmentFilteredService = array_unique($apartment_service_filter);

            if ($apartmentFilteredService) {
                foreach ($apartmentFilteredService as  $apartment) {

                    //  dd($apartment['attributes']->id);
                    $apartment->img_path = url('storage/' .   $apartment['img_path']);
                }
            }

            return response()->json($apartmentFilteredService);
        } else {

            if ($apartment_filter) {
                foreach ($apartment_filter as  $apartment) {

                    //  dd($apartment['attributes']->id);
                    $apartment->img_path = url('storage/' .   $apartment['img_path']);
                }
            }
            return response()->json($apartment_filter);
        }
    }
}
