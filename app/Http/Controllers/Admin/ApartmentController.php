<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Sponsorship;
use Illuminate\Support\Facades\Storage;
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


        $apartments = Apartment::where('user_id', $user_id)
        ->with('sponsorships')
        ->paginate(7);

       

        $apartments_sponsored = [];

        foreach ($apartments  as  $apartment) {
        $count = $apartment->sponsorships;
        if(count($count) > 0){
            $apartments_sponsored[] = $apartment;
        }
        }


        return view('admin.apartments.index', compact('apartments', 'user','apartments_sponsored'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();


        return view('admin.apartments.create', compact('services'));
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
            'img_path' => 'required|mimes:png,jpg,jpeg,bmp,svg,webp',
            'address' => 'required'
        ]);


        $data = $request->all();
        $user = Auth::user();


        $data['user_id'] = $user['id'];
        $data['slug'] = Str::slug($data['title'], '-');

        if (array_key_exists('img_path', $data)) {

            // $img_path = Storage::put('image-apartment', $data['img_path']);
            // $data['img_path'] =  $img_path;
            $data['img_path'] = Storage::put('image-apartment', $data['img_path']);
        }

        $new_apartment = new Apartment();
        $new_apartment->fill($data);
        $new_apartment->save();

        if (array_key_exists('services', $data)) {
            $new_apartment->services()->attach($data['services']);       // Aggiunge nuovi record in pivot
        }

        return redirect()->route('admin.apartments.show', $new_apartment->id);
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

        $user_id = $user_log['id'];



        if ($apartment == null) {
            return abort(404);
        } elseif ($apartment != null && $apartment['user_id'] == $user_id) {
            return view('admin.apartments.show', compact('apartment'));
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

        $user_id = $user_log['id'];


        if ($apartment == null) {
            return abort(404);
        } elseif ($apartment != null && $apartment['user_id'] == $user_id) {
            return view('admin.apartments.edit', compact('services', 'apartment'));
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
            'img_path' => 'nullable|mimes:png,jpg,jpeg,bmp,svg,webp'
        ], []);


        $data =  $request->all();
        $apartment = Apartment::find($id);
        $data['slug'] = Str::slug($data['title'], '-');


        if (array_key_exists('img_path', $data)) {

            if ($apartment->img_path) {
                Storage::delete($apartment->img_path);
            }

            $data['img_path'] = Storage::put('image-apartment', $data['img_path']);
        }

        $apartment->update($data);

        if (array_key_exists('services', $data)) {
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
        if ($apartment->img_path) {
            Storage::delete($apartment->img_path);
        }
        return redirect()->route('admin.apartments.index')->with('deleted', $apartment->title);
    }
}
