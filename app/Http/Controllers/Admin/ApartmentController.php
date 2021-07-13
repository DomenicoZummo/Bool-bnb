<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Sponsorship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user['id'];


        $apartments = Apartment::where('user_id' , $user_id)->get();

       
        return view('admin.apartments.index' , compact('apartments', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();


        return view('admin.apartments.create' , compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'floor' => 'nullable|numeric|integer|between:1,10',
            'rooms' => 'required|numeric|integer|between:1,20',
            'beds' => 'required|numeric|integer|between:1,20',
            'bathrooms' => 'required|numeric|integer|between:1,10',
            'square_meters' => 'nullable|numeric|integer|between:30,300',
            'img_path'=>'required'
        ],[

        ]);


        $data = $request->all();
        $user = Auth::user();


        $data['user_id'] = $user['id'];

        $data['slug'] = Str::slug($data['title'] , '-');

        $new_apartment = new Apartment();

        $new_apartment->fill($data);
        $new_apartment->save();

        if(array_key_exists('services',$data)){
            $new_apartment->services()->attach($data['services']);       // Aggiunge nuovi record in pivot
        }

        return redirect()->route('admin.apartments.show' , $new_apartment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::find($id);
        $user_log = Auth::user();

        $user_id = $user_log ['id'];



        if($apartment == null){
            return abort(404);

        }elseif ($apartment != null && $apartment['user_id'] == $user_id){
            return view('admin.apartments.show',compact('apartment'));
        }
          
        abort(404);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        // $apartment = Apartment::find($id);
        $services = Service::all();

        $user_log = Auth::user();

        $user_id = $user_log ['id'];

        
        if($apartment == null){
            return abort(404);

        }elseif ($apartment != null && $apartment['user_id'] == $user_id){
            return view('admin.apartments.edit',compact('services','apartment'));
        }
          
        abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'floor' => 'nullable|numeric|integer|between:1,10',
            'rooms' => 'required|numeric|integer|between:1,20',
            'beds' => 'required|numeric|integer|between:1,20',
            'bathrooms' => 'required|numeric|integer|between:1,10',
            'square_meters' => 'nullable|numeric|integer|between:30,300',
            'img_path'=>'required'
        ],[

        ]);


        $data =  $request->all();
        $apartment = Apartment::find($id);
        $data['slug'] = Str::slug($data['title'], '-');
        $apartment->update($data);


        if(array_key_exists('services', $data)) {
            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->detach();
        }

        return redirect()->route('admin.apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);

          // Pulizia orfani
          $apartment->services()->detach();
          $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('deleted', $apartment->title);
    }
}
