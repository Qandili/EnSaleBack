<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>window.Laravel={csrfToken:'{{csrf_token()}}'}</script>

    <title>Categories</title>

     <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div id="app">
        <navbar></navbar>
        <div class="container">
            <categories></categories>
        </div>
    </div>
    
    

    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>