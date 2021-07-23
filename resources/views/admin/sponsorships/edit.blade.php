@extends('layouts.app')

@section('content')
    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
        </div>
   
        <div class="text-img col-xs-12 col-md-6">
            <h1>{{ $apartment->title }}</h1>
            <p><strong>Address:</strong> {{ $apartment->address }}</p>
        <div>
        
        @foreach ($sponsorships as $sponsorship )
            <input id= "{{$sponsorship->type}}" name="Sponsorship" type="radio" value="{{$sponsorship->type}}">
            <label for="{{$sponsorship->type}}">
                <span class="mr-1">{{$sponsorship->type}}</span>
                <span class="mr-1">{{$sponsorship->price}}</span>
                <span class="mr-1">{{$sponsorship->duration}}</span>
            </label><br>
            
        @endforeach
        
        </div>
             <div class="d-flex action-show">
                 <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
            </div>
        </div>

    </div>
@endsection