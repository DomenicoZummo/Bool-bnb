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

        intval($services);
       
        $apartment_filter = Apartment::whereBetween('latitude', [($lat - $range / 100), ($lat + $range / 100)])
            ->whereBetween('longitude', [[($lng - $range / 100), ($lng + $range / 100)]])
            ->where('rooms', '>=',  $rooms)
            ->where('beds', '>=',  $beds)
            ->with('user', 'services', 'sponsorships')
            ->get();



            if ($services != null) {
            $listServices = explode(',', $services);

            foreach ($listServices as $servic) {
                $intServ = intval($servic);
                $listIntServices[] = $intServ;
            }
            


            sort($listIntServices);         // Array id numerico della query


            $apartmentFilteredByService = [];

            foreach($apartment_filter as $apartment){
            $services = $apartment->services->find($listIntServices);

            
            

            if(count($services) >= count($listIntServices)){
               
                $apartmentFilteredByService[] = $apartment;
            }

            

        }

        $apartmentFilteredService = array_unique($apartmentFilteredByService);

            if ($apartmentFilteredService) {
                foreach ($apartmentFilteredService as  $apartment) {

                    //  dd($apartment['attributes']->id);
                    $apartment->img_path = url('storage/' .   $apartment['img_path']);
                }
            }

            return response()->json($apartmentFilteredService);

            }else {

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
