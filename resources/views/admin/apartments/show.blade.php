@extends('layouts.app')


@section('content')

    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ $apartment->img_path }}" alt="{{ $apartment->title }}">
        </div>
   
        <div class="text-img col-xs-12 col-md-6">
            <h1>Titolo :  {{ $apartment->title }}</h1>
            <h2>Descrizione : {{ $apartment->description }}</h2>
            <h2>Floor : {{ $apartment->floor }}</h2>
            <h2>Rooms : {{ $apartment->rooms }}</h2>
            <h2>Beds : {{ $apartment->beds }}</h2>
            <h2>Bathrooms : {{ $apartment->bathrooms }}</h2>
            <h2>Square meters : {{ $apartment->square_meters }}</h2>

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
