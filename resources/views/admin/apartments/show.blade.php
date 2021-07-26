@extends('layouts.app')


@section('content')

    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
        </div>

   
        <div class="text-img col-xs-12 col-md-6">
            <h1>{{ $apartment->title }}</h1>
            <p><strong>Address:</strong> {{ $apartment->address }}</p>
            <div class="d-flex">
                @if ($apartment->floor)
                    <p class="mr-3"><strong>Floor:</strong> {{ $apartment->floor }}</p>
                @endif
                <p class="mr-3"><strong>Rooms:</strong> {{ $apartment->rooms }}</p>
                <p class="mr-3"><strong>Beds:</strong> {{ $apartment->beds }}</p>
                <p class="mr-3"><strong>Bathrooms:</strong> {{ $apartment->bathrooms }}</p>
                @if ($apartment->square_meters)
                    <p><strong>Square meters:</strong> {{ $apartment->square_meters }}</p>
                @endif
            </div>
            <div><strong>Descrizione:</strong></div> <p>{{ $apartment->description }}</p>
            
            @if(count($apartment->services) > 0)
                @foreach ($apartment->services as $service)
                <span class="badge badge-primary p-2 my-2">{{$service->name}}</span>
                @endforeach
             @endif

             <div class="d-flex action-show">
                 <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
                 <a class="btn btn-warning mt-5 mr-5" href="{{ route('admin.apartments.edit', $apartment->id) }}">EDIT</a>
                 <form class="mt-5 delete-apartment-form" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                        DELETE
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5" height="400">
        <canvas id="myChart"></canvas>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js'></script>
    <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: '# of Visits',
                            data: [12, 19, 3, 5, 2, 3, 16, 23, 12, 3, 8, 10],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
    </script>
@endsection
