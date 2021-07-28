@extends('layouts.app')

@section('content')
<div class="container color-b">
    <h1 class="mb-5 bold">Dashboard</h1>
    <div class="dash-card-wrapper d-flex flex-wrap">
        <div class="dash-card">
            <a href="{{ route('admin.apartments.index') }}" class="d-flex justify-content-center align-items-center dash-anchor">
                <h2 class="text-center">Your <br>Apartments</h2>
            </a>
        </div>
        <div class="dash-card d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.messages.index') }}" class="d-flex justify-content-center align-items-center dash-anchor">
                <h2 class="text-center">Messages</h2>
            </a>
        </div>
        <div class="dash-card d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.sponsorships.index') }}" class="d-flex justify-content-center align-items-center dash-anchor">
                <h2 class="text-center">Sponsored <br> Apartments</h2>
            </a>
        </div>
        <div class="dash-card d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.apartments.create') }}" class="d-flex justify-content-center align-items-center dash-anchor">
                <h2 class="text-center">Create <br> New Apartment</h2>
            </a>
        </div>
    </div>
</div>
@endsection
.