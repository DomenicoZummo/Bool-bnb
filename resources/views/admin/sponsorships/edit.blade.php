@extends('layouts.app')

@section('content')
    <div class="container d-flex">

       
      <div class="box-img col-xs-12 col-md-6">
          <img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
          <h1 class="mt-4">{{ $apartment->title }}</h1>
          <p><i class="fas fa-map-marker-alt mr-2"></i> {{ $apartment->address }}</p>
      </div>
        

      <div class="content container col-xs-12 col-md-6">
            <form method="POST" id="payment-form" action="{{ route('admin.sponsorships.store')}}">
                
                    @csrf
                    @method('POST')
                    <section>

                <input type="hidden" name="apartment" value="{{$apartment->id}}">


                <div class="d-flex justify-content-center align-items-center">
                  @foreach ($sponsorships as $sponsorship )
                    <div class="card p-3 d-flex justify-content-center align-items-center">
                      <i class="fas fa-medal @if ($sponsorship->type === 'silver')
                        silver
                        @elseif ($sponsorship->type === 'gold')
                        gold
                        @else
                        platinum
                        @endif card-img-top text-center"></i>
                        <div class="card-body">
                          <label for="{{$sponsorship->type}}">
                            <p>Type: {{$sponsorship->type}}</p>
                            <p>Price: {{$sponsorship->price}}€</p>
                            <p>Duration: {{$sponsorship->duration}} Hours</p>
                          </label>
                        </div>
                        <input id= "{{$sponsorship->id}}" checked name="Sponsorship" type="radio" value="{{$sponsorship->id}}">
                      </div>
                  @endforeach
                </div>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <div class="pay text-center"><button class="btn-pay" type="submit"><span>Pay now</span></button></div>
            </form>
            <div class="d-flex action-show">
                  <a class="btn btn-success-details mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
            </div>
        </div>


        
      <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
      <script>
          var form = document.querySelector('#payment-form');
          var client_token = "sandbox_d55cvtp8_6bzmxnhthw48jtq8";
          braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
          }, function (createErr, instance) {
            if (createErr) {
              console.log('Create Error', createErr);
              return;
            }
            form.addEventListener('submit', function (event) {
              event.preventDefault();
              instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                  console.log('Request Payment Method Error', err);
                  return;
                }
                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
              });
            });
          });
      </script>
    </div>
@endsection