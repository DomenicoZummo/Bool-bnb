<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Window title --}}
        <title>Boolbnb</title>
       
        <!-- Scripts -->
        <script src="{{ asset('js/search.js') }}" defer></script>


        <!-- Map -->
        <link
        rel="stylesheet"
        type="text/css"
        href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps.css"
        />
 
        <!-- Search-bar -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css"
        />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- Icon --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <!-- Styles -->
    </head>
    <body>
        <div class="container pt-5">
        </div>
       <div id="root"></div>
       <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
