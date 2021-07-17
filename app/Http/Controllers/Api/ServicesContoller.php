<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class ServicesContoller extends Controller
{
    public function index(Request $request)
    {


        $services = Service::all();

        return response()->json( $services);
        
        // if($apartment_filter){
        //     foreach ($apartment_filter as  $apartment) {
        //         $apartment['img_path'] = url('storage/'.   $apartment['img_path']);
        //     }
            
        //  }



    }
}
