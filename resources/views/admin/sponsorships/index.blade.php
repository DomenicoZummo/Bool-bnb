@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap">
        @foreach ($apartments_sponsored as $apartment )
        <div class="card m-3" style="width: 18rem; ">
            <img class="card-img-top" src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
            <div class="card-body">
              <h5 class="card-title">{{$apartment->title}}</h5>
              <span>{{$apartment->address}}</span>
              <h3 class="card-text"> <p> 
                <i class="fas fa-medal @if ($apartment->sponsorships[0]['id'] == 1)
                    silver
                    @elseif ($apartment->sponsorships[0]['id'] == 2)
                    gold
                    @else
                    platinum
                @endif"></i>
                  
                </p></h3>
            </div>
          </div>
        @endforeach
    </div>
@endsection