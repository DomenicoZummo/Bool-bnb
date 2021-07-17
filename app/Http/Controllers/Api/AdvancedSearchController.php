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

        $lat = $query['lat'];
        $lng = $query['lng'];
        $range = $query['range'];
        $services = $query['services'];
       



        $apartment_filter= Apartment::whereBetween('latitude', [($lat - $range /100),($lat + $range/100)])
        ->whereBetween('longitude', [[($lng - $range/100),($lng + $range/100)]])->with('user', 'services' , 'sponsorships')->get();


       $apartment_filter_service = [];



        foreach ($apartment_filter as $apartment) {

            $service_apartment = $apartment->services;

            foreach ($service_apartment as $service) {
                $id_service = strtolower($service['name']);
                $test[] =  $id_service;
                if(strpos($services, $id_service)){
                    $apartment_filter_service[] = $apartment;
                }

            }


        }

      
        dd($test);



        if( $apartment_filter_service){
            foreach ($apartment_filter as  $apartment) {
                $apartment['img_path'] = url('storage/'.   $apartment['img_path']);
            }
            
         }

        
        return response()->json(  $apartment_filter_service);

    }
}
