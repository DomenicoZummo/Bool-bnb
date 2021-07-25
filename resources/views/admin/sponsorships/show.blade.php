@extends('layouts.app')

@section('content')
    <div class="container d-flex">

   
        <div class="text-img col-xs-12 col-md-6">

            <h1>{{ $apartment->title }}</h1>

            <h3>Transaction successful. The ID is: {{$transaction->id}}</h3>
            
            {{-- <h3>Created at: {{$transaction->createdAt}}</h3> --}}

            <h4>By: {{$transaction->customer['firstName']}} {{$transaction->customer['lastName']}}</h4>

            <h4>Email: {{$transaction->customer['email']}}</h4>

            <h4>Card: {{$transaction->creditCard['cardType']}}
                <img src="{{ $transaction->creditCardDetails->imageUrl}}" alt=""> 
            </h4>

                       

            <h4>Number: {{$transaction->creditCardDetails->maskedNumber}}</h4>

            <h4>Type Sponsorship: {{$sponsorships->type}}</h4>

            <h4>Duration: {{$sponsorships->duration}}</h4>

            <h4>Created at: {{$sponsorships->created_at}}</h4>
            

            <h3>Price: {{ $transaction->amount}} {{$transaction->currencyIsoCode}}</h3>

        
             <div class="d-flex action-show">
                 <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection