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
                    <th>Apartment name</th>
                    <th>Address</th>
                    <th >Publication Date</th>
                    <th class="text-center">Sponsor</th>
                    <th colspan="3" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($apartments as $apartment )
                    
                    <tr>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ $apartment->address }}</td>

                        <td>
                            <div>{{ $apartment->created_at->format('l d/m/y') }}</div>
                            <div>{{ $apartment->created_at->diffForHumans() }}</div>
                        </td>

                        <td class="text-center">
                            @if (count($apartment->sponsorships) > 0)
                            <i class="fas fa-medal @if ($apartment->sponsorships[0]['id'] == 1)
                                silver
                                @elseif ($apartment->sponsorships[0]['id'] == 2)
                                gold
                                @else
                                platinum
                            @endif"></i>
                            @else    
                            <a class="btn btn-success" href="{{ route('admin.sponsorships.edit', $apartment->id) }}">Sponsor </a>
                            @endif
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

        {{ $apartments->links() }}

    </div>
@endsection