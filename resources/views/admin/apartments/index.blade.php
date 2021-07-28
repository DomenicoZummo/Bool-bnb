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


          <div class="container d-flex flex-wrap justify-content-center">
            @foreach ($apartments as $apartment )
            <div class="card card-back card-apartment mt-3 mb-3 pb-2">
                <div class="img-box"><img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}"></div>
                <div class="card-body">
                    <h4 class="card-title tit">{{$apartment->title}}</h4>
                    <p><i class="fas fa-map-marker-alt mr-2"></i>{{$apartment->address}}</p>
                    <p class="p-no-mb"><strong>Publication date: </strong>
                        <div class="no-line-spacing">
                            <div>{{ $apartment->created_at->format('l d/m/y') }}, {{ $apartment->created_at->diffForHumans() }}</div>
                        </div>
                    </p>
                    <p class="ml-3 absolute-sponsor">
                    @if (count($apartment->sponsorships) > 0)
                            <i class="fas fa-medal ind medal-apartment @if ($apartment->sponsorships[0]['id'] == 1)
                                silver
                                @elseif ($apartment->sponsorships[0]['id'] == 2)
                                gold
                                @else
                                platinum
                            @endif"></i>
                    @else
                        <a class="btn btn-success-sponsor" href="{{ route('admin.sponsorships.edit', $apartment->id) }}">Sponsor Now</a>
                    @endif
                    </p>
                    <p class="d-flex justify-content-between">
                        <a class="btn btn-success-details absolute-details" href="{{ route('admin.apartments.show' , $apartment->id) }}">Details</a>
                        <a class="btn btn-warning-edit absolute-edit" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a>
                        <form class="delete-apartment-form absolute-delete" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger-delete" type="submit">
                                Delete
                            </button>
                        </form>
                    </p>
                </div>
              </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $apartments->links() }}
        </div>
      </div>

    {{-- <div class="container">

       
        
        <h1>Your apartments</h1>

        

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
                            <a class="btn btn-success" href="{{ route('admin.apartments.show' , $apartment->id) }}">Details</a>
                        </td>


                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a>
                        </td>

                        <td>
                            <form class="delete-apartment-form" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

        

    </div>
@endsection