<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            @yield('content')

            <script src="{{ mix('js/app.js') }}"></script>
        </div>
    </body>
</html>
