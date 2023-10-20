<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.include')
    <title>SUNI Indonesia | @yield('title')</title>
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