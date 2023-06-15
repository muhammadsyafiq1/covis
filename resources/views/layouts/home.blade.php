<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Page Title  -->
    <title>COVIS | Collateral Site Visit</title>

    <!-- StyleSheets  -->
    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('') }}assets/css/dashlite.css?ver=2.9.1">
    <link id="skin-default" rel="stylesheet" href="{{ asset('') }}assets/css/theme.css?ver=2.9.1">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/datepicker/dist/datepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">

    @stack('addon-style')

</head>

<body class="nk-body npc-invest bg-lighter">
    <div class="nk-app-root">
        <div class="nk-wrap">
            @yield('content')
            @include('layouts.footer')
        </div>
    </div>
    @stack('prepend-script')
    @include('layouts.script')
    @stack('addon-script')
</body>

</html>
