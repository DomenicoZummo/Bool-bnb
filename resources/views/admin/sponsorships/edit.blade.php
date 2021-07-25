@extends('layouts.app')

@section('content')
    <div class="container d-flex">
       
        <div class="box-img col-xs-12 col-md-6">
            <img src="{{ asset('storage/' . $apartment->img_path) }}" alt="{{ $apartment->title }}">
        </div>
   
        <div class="text-img col-xs-12 col-md-6">
            <h1>{{ $apartment->title }}</h1>
            <p><strong>Address:</strong> {{ $apartment->address }}</p>
        <div>
        

        
        </div>
             <div class="d-flex action-show">
                 <a class="btn btn-success mt-5 mr-5" href="{{ route('admin.apartments.index') }}">Back</a>
            </div>
            <div class="content">
                <form method="POST" id="payment-form" action="{{ route('admin.sponsorships.store', $apartment->id)}}">
                    
                    @csrf
                    @method('POST')
                    
                    <section>

                <input type="hidden" name="apartment" value="{{$apartment->id}}">


                @foreach ($sponsorships as $sponsorship )
                    <input id= "{{$sponsorship->id}}" name="Sponsorship" type="radio" value="{{$sponsorship->id}}">
                    <label for="{{$sponsorship->type}}">
                        <span class="mr-1">{{$sponsorship->type}}</span>
                        <span class="mr-1">{{$sponsorship->price}}</span>
                        <span class="mr-1">{{$sponsorship->duration}}</span>
                    </label><br>
                    
                @endforeach

                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>

                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button" type="submit"><span>Test Transaction</span></button>
                </form>
            </div>
        </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "sandbox_d55cvtp8_6bzmxnhthw48jtq8";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
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