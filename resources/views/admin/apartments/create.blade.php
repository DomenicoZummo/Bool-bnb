@extends('layouts.app')

@section('script')
<script src="{{ asset('js/tomtom.js') }}" defer></script>
@endsection


@section('content')
<div class="container">
    <h1>Create</h1>
    <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

        {{-- Title --}}
        <div class="mt-3">
            <label class="form-label" for="title">Name  *</label>
            <input class="form-control @error('title') is-invalid @enderror" required type="text"  id="title" name="title" value="{{ old('title') }}">
            @error('title')
            <span class="invalid-feedback">{{ $message  }}</span>
            @enderror
        </div>


        {{-- Description --}}
        <div class="mt-3">
            <label class="form-label" for="description">Description  *</label>
            <textarea name="description" class=" @error('description') is-invalid @enderror" required id="description" cols="50" rows="10">{{ old('description') }}</textarea>
            @error('description')
            <span class="invalid-feedback">{{ $message  }}</span>
            @enderror
        </div>

        <div class="d-flex">
            {{-- Floor --}}
            <div class="mt-3 mr-3">
                <label class="form-label" for="floor">Floor</label>
                <input id="floor" class=" @error('floor') is-invalid @enderror" min="1" max="10" name="floor" type="number" value="{{ old('floor') }}">
                @error('floor')
                <span class="invalid-feedback">{{ $message  }}</span>
                @enderror
            </div>


            {{-- Rooms --}}
            <div class="mt-3 mr-3">
                <label class="form-label" for="rooms">Rooms  *</label>
                <input id="rooms" name="rooms"  class="@error('rooms') is-invalid @enderror" required min="1" max="20" type="number" value="{{ old('rooms') }}">
                @error('rooms')
                <span class="invalid-feedback">{{ $message  }}</span>
                @enderror
            </div>


            {{-- Beds --}}
            <div class="mt-3 mr-3">
                <label class="form-label" for="beds">Beds  *</label>
                <input id="beds" name="beds" class=" @error('beds') is-invalid @enderror" min="1"  max="20" required type="number" value="{{ old('beds') }}">
                @error('beds')
                <span class="invalid-feedback">{{ $message  }}</span>
                @enderror
            </div>


            {{-- Bathrooms --}}
            <div class="mt-3 mr-3">
                <label class="form-label" for="bathrooms">Bathrooms  *</label>
                <input id="bathrooms" name="bathrooms" class="@error('bathrooms') is-invalid @enderror" min="1" max="20" required type="number" value="{{ old('bathrooms') }}">
                @error('bathrooms')
                <span class="invalid-feedback">{{ $message  }}</span>
                @enderror
            </div>


            {{-- Square_meters --}}
            <div class="mt-3">
                <label class="form-label" for="square_meters">Square_meters</label>
                <input id="square_meters" name="square_meters" class=" @error('square_meters') is-invalid @enderror " min="30" max="300"  type="number" value="{{ old('square_meters') }}">
                @error('square_meters')
                <span class="invalid-feedback">{{ $message  }}</span>
                @enderror
            </div>
        </div>


        {{-- Services --}}
        <h4 class="my-3">Services</h4>
        <div class="mb-3">
            @foreach ($services as $service)
                <span class="d-inline-block mr-3">
                    <input type="checkbox" name="services[]" id="service{{$loop->iteration}}" value="{{ $service->id }}"
                    @if (in_array($service->id, old('services',[])))
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
            <label class="form-label" for="img_path">Image  *</label>
            <input class="form-control-file @error('img_path') is-invalid @enderror"  type="file" required id="img_path" name="img_path">
            @error('img_path')
            <span class="invalid-feedback">{{ $message  }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label mt-3" for="address">Address  *</label>
            <input type="hidden" id="lat" name="latitude" class="form-control" value="{{ old('latitude') }}">
            <input type="hidden" id="lng" name="longitude" class="form-control" value="{{ old('longitude') }}">
            <input type="hidden" id="address" name="address" required class="form-control" value="{{ old('address') }}">
            
            @error('address')
            <span class="alert alert-danger my-3 p-2">{{ $message }}</span>
            @enderror
            
            <div id="searchbox-back" class="mb-3"></div>
            <div id="map" class="map map-displayed"></div>

            <div class="mt-3 d-flex">
                <input class="mr-1"  type="radio" id="public" name="visibility" checked value="1">
                <label class="mr-5" for="public">Visible</label><br>
                <input class="mr-1" type="radio" id="private" name="visibility" value="0">
                <label for="private">Not Visible</label><br>
            </div>


            <div class="text-center final-button">
                <input type="submit" value="Create" class="btn btn-success">
            </div>
        </div>

        
    </form>
    <a href="{{ route('admin.apartments.index') }}">Back</a>
</div>
@endsection