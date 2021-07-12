@extends('layouts.app')



@section('content')
<div class="container">
    <h1>EDIT</h1>
    <form action="{{ route('admin.apartments.update' , $apartment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Title --}}
        <div class="mt-3">
            <label class="form-label" for="title">Name</label>
            <input value="{{ old('title',$apartment->title) }}" class="form-control " type="text" id="title" name="title">
        </div>

        {{-- Description --}}
        <div class="mt-3">
            <label class="form-label" for="description">Description</label>
            <textarea name="description" id="description" cols="50" rows="10">{{ old('description',$apartment->description) }}</textarea>
        </div>

        <div class="d-flex">
            {{-- Floor --}}
        <div class="mt-3 mr-3">
            <label class="form-label" for="floor">Floor</label>
            <input id="floor" name="floor" min="1" max="10" value="{{ old('floor',$apartment->floor) }}" type="number">
        </div>


        {{-- Rooms --}}
        <div class="mt-3 mr-3">
            <label class="form-label" for="rooms">Rooms</label>
            <input value="{{ old('rooms',$apartment->rooms) }}" id="rooms" name="rooms" min="1" max="20" type="number">
        </div>


        {{-- Beds --}}
        <div class="mt-3 mr-3">
            <label class="form-label" for="beds">Beds</label>
            <input value="{{ old('beds',$apartment->beds) }}" id="beds" name="beds" min="1" max="20" type="number">
        </div>


        {{-- Bathrooms --}}
        <div class="mt-3 mr-3">
            <label class="form-label" for="beds">Bathrooms</label>
            <input value="{{ old('bathrooms',$apartment->bathrooms) }}" id="bathrooms" name="bathrooms" min="1" max="10" type="number">
        </div>


        {{-- Square_meters --}}
        <div class="mt-3">
            <label class="form-label" for="beds">Square_meters</label>
            <input value="{{ old('square_meters',$apartment->square_meters) }}" id="square_meters" name="square_meters" min="30" max="300" type="number">
        </div>
    </div>

    {{-- services --}}

    <h4 class="my-3">Services</h4>
    <div class="mb-3">
        @foreach ($services as $service)
            <span class="d-inline-block mr-3">
                <input type="checkbox" name="services[]" id="service{{$loop->iteration}}" value="{{ $service->id }}"
                @if (($errors->any() && in_array($service->id, old('services'))))
                    checked
                    @elseif(! $errors->any() && $apartment->services->contains($service->id))
                    checked
                @endif
                >

                <label for="service{{$loop->iteration}}">{{ $service->name }}</label>
            </span>

        @endforeach


    @error('services')
        <p class="invalid feedback">{{ $message }}</p>
    @enderror

    </div>

        {{-- Img path --}}

        <div class="mt-3">
            <label class="form-label" for="img_path">Image</label>
            <input value="{{ old('img_path',$apartment->img_path) }}" class="form-control " type="text" id="img_path" name="img_path">
        </div>





        <div class="form-group">
            <label class="form-label" for="address">Address</label>
            <input type="hidden" id="address" name="address" class="form-control" value="{{ old('address' , $apartment->address) }}">
            @error('address')
            <span class="alert alert-danger"></span>
            @enderror
            <input type="hidden" id="lat" name="longitude" class="form-control" value="{{ old('latitude' , $apartment->latitude) }}">
            <input type="hidden" id="lng" name="latitude" class="form-control" value="{{ old('longitude' , $apartment->longitude) }}">
            
            <div id="searchbox"></div>
            <div id="map" class="map"></div>


            <div class="mt-3 d-flex">
                <input class="mr-1"  type="radio" id="public" name="visibility" @if(1 == old('visibility' , $apartment->visibility)) 
                checked 
                @endif
                value="1">
                <label class="mr-5" for="public">Public</label><br>
                <input class="mr-1" type="radio" id="private" name="visibility"@if(0 == old('visibility' , $apartment->visibility)) 
                checked @endif value="0">
                <label for="private">Private</label><br>
            </div>


            <div class="text-center final-button">
                <input type="submit" value="Edit" class="btn btn-success">
            </div>
        </div>

        
    </form>
    <a href="{{ route('admin.apartments.index') }}">Back</a>
</div>
@endsection