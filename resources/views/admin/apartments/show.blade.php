@extends('layouts.app')


@section('content')

    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
        </div>

   
        <div class="text-img col-xs-12 col-md-6">
            <h1>{{ $apartment->title }}</h1>
            <p><strong>Address:</strong> {{ $apartment->address }}</p>
            <div class="d-flex">
                @if ($apartment->floor)
                    <p class="mr-3"><strong>Floor:</strong> {{ $apartment->floor }}</p>
                @endif
                <p class="mr-3"><strong>Rooms:</strong> {{ $apartment->rooms }}</p>
                <p class="mr-3"><strong>Beds:</strong> {{ $apartment->beds }}</p>
                <p class="mr-3"><strong>Bathrooms:</strong> {{ $apartment->bathrooms }}</p>
                @if ($apartment->square_meters)
                    <p><strong>Square meters:</strong> {{ $apartment->square_meters }}</p>
                @endif
            </div>
            <div><strong>Descrizione:</strong></div> <p>{{ $apartment->description }}</p>
            
            @if(count($apartment->services) > 0)
                @foreach ($apartment->services as $service)
                <span class="badge badge-primary p-2 my-2">{{$service->name}}</span>
                @endforeach
             @endif

             <div class="d-flex action-show">
                 <a class="btn btn-success-details mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
                 <a class="btn btn-warning-edit mt-5 mr-5" href="{{ route('admin.apartments.edit', $apartment->id) }}">EDIT</a>
                 <form class="mt-5 delete-apartment-form" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger-delete" type="submit">
                        DELETE
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
