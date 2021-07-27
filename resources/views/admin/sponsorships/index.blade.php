@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap justify-content-center">
        @foreach ($apartments_sponsored as $apartment )
        <div class="card card-back mt-3 mb-3 pb-2">
            <img class="img-box" src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
            <div class="card-body">
              <h5 class="card-title tit">{{$apartment->title}}</h5>
                <span class="ml-3"> 
                <i class="fas fa-medal ind @if ($apartment->sponsorships[0]['id'] == 1)
                    silver
                    @elseif ($apartment->sponsorships[0]['id'] == 2)
                    gold
                    @else
                    platinum
                @endif"></i>
                  
                </span>
              <p><i class="fas fa-map-marker-alt mr-1"></i
                        >{{$apartment->address}}</p>

            </div>
          </div>
        @endforeach
    </div>
@endsection