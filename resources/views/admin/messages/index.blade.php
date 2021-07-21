@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your messages</h1>

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
                @foreach ($user_messages as $message )
                    <tr>
                        <td>
                            {{ $message->name }}
                        </td>
                        <td>
                            {{ $message->email }}
                        </td>
                        <td>
                            {{ $message->message }}
                        </td>
                        <td>
                            {{ $message->apartment->title }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection