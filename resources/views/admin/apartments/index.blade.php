@extends('layouts.app')

@section('content')


    <div class="container">
        <h1>Your apartaments</h1>

        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                Succesfully deleted item.
            </div>
        @endif

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Apartment name</th>
                    <th>Address</th>
                    <th>Publication Date</th>
                    <th colspan="3" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($apartments as $apartament )
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $apartament->title }}</td>
                        <td>{{ $apartament->address }}</td>

                        <td>
                            <div>{{ $apartament->created_at->format('l d/m/y') }}</div>
                            <div>{{ $apartament->created_at->diffForHumans() }}</div>
                        </td>

                        <td>
                            <a class="btn btn-success" href="{{ route('admin.apartments.show' , $apartament->id) }}">Show</a>
                        </td>


                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartament->id) }}">EDIT</a>
                        </td>

                        <td>
                            <form class="delete-apartment-form" action="{{ route('admin.apartments.destroy', $apartament->id) }}" method="POST">
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