@section('content')
<head>
    <title>EnSale</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>window.Laravel={csrfToken:'{{csrf_token()}}'}</script>
     <!-- Fonts -->
    <link href="/fontawesome 5.8.2/css/all.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <mainapp></mainapp>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
