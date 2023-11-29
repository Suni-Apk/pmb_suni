<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ App\Models\General::first()->image }}">

    @include('layouts.include')
    
    <title>{{ App\Models\General::first()->title }} | @yield('title')</title>
</head>
<body>
    @include('auth.layouts.header')
    
    <main class="main-content mt-0">
        @yield('content')
    </main>

    @include('auth.layouts.footer')
    @include('layouts.script')
</body>
</html>