@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mr-5">Your messages</h1>
        {{-- <div class="new-message ">
            @if (count($unread_messages))
            <span class="fs-6 alert alert-success">Unread messages<span class="num-message">{{ count($unread_messages) }}</span></span>
        @else
            <span class="fs-6 alert alert-secondary">No new messages</span>
        @endif
        </div> --}}

        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                Succesfully deleted item.
            </div>
        @endif
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th>Guest</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Name apartment</th>
                    <th>Send date</th>
                    <th>Read</th>

                    <th colspan="3" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($user_messages as $message )
                    <tr class="@if($message->read == 0) bold @endif">
                        <td>{{ $message->name }}</td>
                        <td>
                            {{ $message->email }}
                        </td>
                        <td>
                            {{Str::limit($message->message, 30, ' ...')}}
                        </td>
                        <td>
                            @if (isset($message->apartment->title))
                                {{ $message->apartment->title }}
                            @endif
                        </td>
                        <td>
                            <div>{{ $message->created_at->format('l d/m/y') }}</div>
                            <div>{{ $message->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="text-center @if($message->read == 1) read-true @endif">
                            <i class="far fa-check-circle"></i>
                        </td>
                        <td>
                            <form  action="{{ route('admin.messages.show', $message->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if (isset($message->apartment->title))
                                    <button class="btn btn-success-details" type="submit">
                                        Read
                                    </button>
                                @endif 
                            </form>

                        </td>

                        <td>
                            <form class="delete-apartment-form" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger-delete" type="submit">
                                    DELETE
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $messages->links() }}

    </div>
@endsection