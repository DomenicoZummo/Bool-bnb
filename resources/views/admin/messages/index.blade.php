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
                    <th>Guest</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Name apartment</th>
                    <th>Send date</th>
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
                            {{Str::limit($message->message, 30, ' ...')}}
                        </td>
                        <td>
                            {{ $message->apartment->title }}
                        </td>
                        <td>
                            <div>{{ $message->created_at->format('l d/m/y') }}</div>
                            <div>{{ $message->created_at->diffForHumans() }}</div>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.messages.show' , $message->id) }}">Show</a>
                        </td>

                        <td>
                            <form class="delete-apartment-form" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
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