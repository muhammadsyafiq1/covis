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

    <body class="nk-body bg-white npc-general pg-error">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- wrap @s -->
                <div class="nk-wrap nk-wrap-nosidebar">
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="nk-block nk-block-middle wide-md mx-auto">
                            <div class="nk-block-content nk-error-ld text-center">
                                <img class="nk-error-gfx" src="images/gfx/error-404.svg" alt="">
                                <div class="wide-xs mx-auto">
                                    <h3 class="nk-error-title">Oops! Why you’re here?</h3>
                                    <p class="nk-error-text">We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.</p>
                                    <a href="javascript:history.back()" class="btn btn-lg btn-primary mt-2">Go Back</a>
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div>
                    <!-- wrap @e -->
                </div>
                <!-- content @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        
        <!-- JavaScript -->
        <script src="./assets/js/bundle.js?ver=2.9.1"></script>
        <script src="./assets/js/scripts.js?ver=2.9.1"></script>
        
    </body>
</html>