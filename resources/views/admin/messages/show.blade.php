@extends('layouts.app')


@section('content')

    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $message->apartment->img_path) }}" alt="{{ $message->apartment->img_path }}">
        </div>
   
        <div class="text-img col-xs-12 col-md-6">
        <h2 class="mb-3 ">{{ $message->apartment->title}}</h2>

        <h4>Messaggio inviato da: </h4> 
        <p>{{ $message->name}} {{ $message->surname}}</p>
        
        <h4>Email:</h4>
        <p>{{ $message->email }}</p>

        <h4>Testo:</h4>
        <p>{{ $message->message}}</p>

        <h4>Visibility:</h4>
        <p>{{ $message->read}}</p>

            <div class="d-flex action-show">
                <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.messages.index') }}">Back</a>
                <form class="mt-5 delete-apartment-form " action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
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
