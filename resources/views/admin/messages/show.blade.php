@extends('layouts.app')


@section('content')

    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $message->apartment->img_path) }}" alt="{{ $message->apartment->img_path->title }}">
        </div>
   
        <div class="text-img col-xs-12 col-md-6">

            @if(count($message->apartment->services) > 0)
                @foreach ($message->apartment->services as $service)
                    <span class="badge badge-primary p-2 my-2">{{$service->name}}</span>
                @endforeach
             @endif

            <div class="d-flex action-show">
                <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.messages.index') }}">Back</a>
                <form class="mt-5 delete-apartment-form" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
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
