<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Sponsorship;
use Braintree;
use Carbon\Carbon;







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
    public function create($id)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  $request->all();
        
        $sponsorship = Sponsorship::find($data['Sponsorship']);
        $apartment_id = $data['apartment'];

        $sponsorship_id = $data['Sponsorship'];
        

       
        $user_log = Auth::user();

        $sponsorships = Sponsorship::find($sponsorship_id);

        $apartment = Apartment::find($apartment_id);

            $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6bzmxnhthw48jtq8',
            'publicKey' => 'nqgtdy3vspxznd5r',
            'privateKey' => 'f1cdb48bea89bfcfa8fc60941eb2aebd'
            ]);

            
            $amount = $sponsorships->price ;

            $nonce = $request->payment_method_nonce;

            $result = $gateway->transaction()->sale([
            'amount' => $amount,    
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $user_log['name'], // Dati statici da cambiare in base all'user
                'lastName' => $user_log['surname'],
                'email' => $user_log['email'],
            ],
            'options' => [
                'submitForSettlement' => true
            ]
    ]);

        
    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        /**
         * relation in pivot table with duration
         */
        $apartment->sponsorships()->attach($sponsorship_id, ['created_at' => Carbon::now(), 'end_time' => Carbon::now()->addHours($sponsorship['duration'])]);
        
        return view('admin.sponsorships.show', compact('transaction', 'sponsorships', 'apartment'));

        // return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($apartment)
    {
        
        $apartment = Apartment::all();
        $user_log = Auth::user();


        $user_id = $user_log['id'];

        

        
        
        if ($apartment == null) {
            return abort(404);
        } elseif ($apartment != null && $apartment['user_id'] == $user_id) {

            
            return view('admin.sponsorships.show', compact('apartment', 'transaction'));
        }

        abort(404);




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
    //     $data =  $request->all();
    //     $apartment = Apartment::find($id);
    //     $user_log = Auth::user();

    //     $sponsorships = Sponsorship::find($_POST['Sponsorship']);

    //     $apartment->update($data);


    //         $gateway = new Braintree\Gateway([
    //         'environment' => 'sandbox',
    //         'merchantId' => '6bzmxnhthw48jtq8',
    //         'publicKey' => 'nqgtdy3vspxznd5r',
    //         'privateKey' => 'f1cdb48bea89bfcfa8fc60941eb2aebd'
    //         ]);

            
    //         $amount = $sponsorships->price ;

    //         $nonce = $request->payment_method_nonce;

    //         $result = $gateway->transaction()->sale([
    //         'amount' => $amount,    
    //         'paymentMethodNonce' => $nonce,
    //         'customer' => [
    //             'firstName' => $user_log['name'], // Dati statici da cambiare in base all'user
    //             'lastName' => $user_log['surname'],
    //             'email' => $user_log['email'],
    //         ],
    //         'options' => [
    //             'submitForSettlement' => true
    //         ]
    // ]);

        
    // if ($result->success) {
    //     $transaction = $result->transaction;
    //     // header("Location: transaction.php?id=" . $transaction->id);

    //     return view('admin.sponsorships.show', compact('apartment', 'transaction', 'sponsorships'));
        


    //     // return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    // } else {
    //     $errorString = "";

    //     foreach ($result->errors->deepAll() as $error) {
    //         $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    //     }

    //     // $_SESSION["errors"] = $errorString;
    //     // header("Location: index.php");
    //     return back()->withErrors('An error occurred with the message: '.$result->message);
    // }

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
