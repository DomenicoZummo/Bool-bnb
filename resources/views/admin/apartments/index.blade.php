@extends('layouts.app')

@section('content')


    <div class="container">
        <h1>Your apartments</h1>

        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                Succesfully deleted item.
            </div>
        @endif

        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Apartment name</th>
                    <th>Address</th>
                    <th>Publication Date</th>
                    <th colspan="4" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($apartments as $apartment )
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>

                        <td>
                            <div>{{ $apartment->created_at->format('l d/m/y') }}</div>
                            <div>{{ $apartment->created_at->diffForHumans() }}</div>
                        </td>

                        <td>
                            <a class="btn btn-success" href="{{ route('admin.sponsorships.edit', $apartment->id) }}">Sponsor </a>
                        </td>

                        <td>
                            <a class="btn btn-success" href="{{ route('admin.apartments.show' , $apartment->id) }}">Show</a>
                        </td>


                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">EDIT</a>
                        </td>

                        <td>
                            <form class="delete-apartment-form" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    DELETE
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection