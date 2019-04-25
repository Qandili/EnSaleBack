@extends('includes.appContainer')
@section('content')
    <body>
        <div id="app">
            <login-component></login-component>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
