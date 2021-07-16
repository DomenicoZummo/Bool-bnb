@extends('layouts.app')


@section('content')

    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
        </div>
   
        <div class="text-img col-xs-12 col-md-6">
            <h1>Titolo: </h1> <p>{{ $apartment->title }}</p>
            <h2>Descrizione: </h2> <p>{{ $apartment->description }}</p>
            <h2>Address: </h2> <p>{{ $apartment->address }}</p>
            <h2>Floor: </h2> <p>{{ $apartment->floor }}</p>
            <h2>Rooms: </h2> <p>{{ $apartment->rooms }}</p>
            <h2>Beds: </h2> <p>{{ $apartment->beds }}</p>
            <h2>Bathrooms: </h2> <p>{{ $apartment->bathrooms }}</p>
            <h2>Square meters: </h2> <p>{{ $apartment->square_meters }}</p>

            @if(count($apartment->services) > 0)
                @foreach ($apartment->services as $service)
                    <span class="badge badge-primary p-2 my-2">{{$service->name}}</span>
                @endforeach
             @endif

            <div class="d-flex action-show">
                <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
                <a class="btn btn-warning mt-5 mr-5" href="{{ route('admin.apartments.edit', $apartment->id) }}">EDIT</a>
                <form class="mt-5 delete-apartment-form" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                        DELETE
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
