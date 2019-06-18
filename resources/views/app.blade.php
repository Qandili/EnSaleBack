@section('content')
<head>
    <title>EnSale</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>window.Laravel={csrfToken:'{{csrf_token()}}'}</script>
    <!-- Fonts -->
    <link href="/fontawesome 5.8.2/css/all.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
</head>
<body>
    <div id="app">
        hi
        <mainapp></mainapp>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
