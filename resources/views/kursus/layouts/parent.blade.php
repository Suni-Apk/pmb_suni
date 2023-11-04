<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/soft-ui-dashboard-main/assets/img/favicon.png">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SUNI Indonesia | @yield('title')</title>
    
    @include('layouts.include')
    @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100 g-sidenav-hidden">
    @include('kursus.layouts.aside')

    <main class="main-content position-relative min-height-screen h-auto border-radius-lg">

        <div class="z-3 position-relative">
            {{-- @include('layouts.header') --}}
            @component('kursus.layouts.header')
            @endcomponent
        </div>
        
        {{-- @include('layouts.template') --}}
        <div class="z-1 position-relative">
            <div class="container-fluid py-4">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </main>

    @include('layouts.custom')

    @include('layouts.script')
    @stack('scripts')
</body>
</html>