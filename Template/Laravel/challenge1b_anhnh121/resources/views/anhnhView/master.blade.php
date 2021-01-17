<html>
    <head>
        <meta charset="utf-8">
        <title>Master Blade</title>
        <link rel="stylesheet" href="{{asset('anhnh_css/anhnh_style.css')}}"/>
    </head>
    <body>
        @include('anhnhView.header')
        <div id='anhnh'>
        <h1>Master</h1>
<!--        Content start Here-->
        @yield('content')
        </div>
        @include('anhnhView.footer')
    </body>
</html>
