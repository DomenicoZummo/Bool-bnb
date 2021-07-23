<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Sponsorship;



class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sponsorships.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $sponsorships = Sponsorship::all();

        // return view('admin.sponsorships.create', compact('$sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //Validazione

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $apartment = Apartment::find($id);
        // $user_log = Auth::user();

        

        // $user_id = $user_log['id'];



        // if ($apartment == null) {
        //     return abort(404);
        // } elseif ($apartment != null && $apartment['user_id'] == $user_id) {
        //     return view('admin.sponsorships.show', compact('apartment'));
        // }

        // abort(404);

        // return view('admin.sponsorships.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $apartment = Apartment::find($id);
        $user_log = Auth::user();
        $sponsorships = Sponsorship::all();

        

        $user_id = $user_log['id'];



        if ($apartment == null) {
            return abort(404);
        } elseif ($apartment != null && $apartment['user_id'] == $user_id) {
            return view('admin.sponsorships.edit', compact('apartment','sponsorships'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
