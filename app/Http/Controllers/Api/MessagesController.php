<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Message;
use App\Apartment;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->query());
        // $query = $request->query();
        // $slug = $query['slug'];

        // $apartment = Apartment::where('slug', $slug)->get();
        // dd($apartment['0']['id']);

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => ['nullable','string','max:30'],
            'surname' => ['nullable','string','max:30'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required','string' , 'max:1000']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $data = $request->all();
        // dd($data);

        // New instance on db
        $new_message = new Message();

        // Populating new instance
        $new_message->fill($data);

        // Save
        $new_message->save();

        return response()->json($data);
    }
}
