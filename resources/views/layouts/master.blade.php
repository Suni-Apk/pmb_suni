@php
    $biodata = App\Models\Biodata::where('program_belajar', 'S1')
        ->where('user_id', Auth::user()->id)
        ->first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ App\Models\General::first()->image }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ App\Models\General::first()->title }} | @yield('title')</title>

    @include('layouts.include')
    @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100 overflow-x-hidden position-relative">
    @include('layouts.aside')

    <main class="main-content position-relative min-height-screen h-auto border-radius-lg">

        <div class="z-3 position-relative">
            @include('layouts.header')
        </div>

        {{-- @include('layouts.template') --}}
        <div class="z-1 position-relative">
            <div class="container-fluid py-4">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </main>

    {{-- @include('layouts.custom') --}}

    @include('layouts.script')
    @stack('scripts')
</body>

</html>
