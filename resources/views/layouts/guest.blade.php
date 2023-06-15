<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="images/favicon.png">

        <!-- Page Title  -->
        <title>COVIS | Collateral Site Visit</title>

        <!-- StyleSheets  -->
        <link rel="stylesheet" href="assets/css/dashlite.css?ver=2.9.1">
        <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=2.9.1">

    </head>
    <body class="nk-body bg-white npc-general pg-auth">
        {{ $slot }}
    </body>
</html>
