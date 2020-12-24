<!DOCTYPE html>
<html lang="es-VE">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="{{asset("styles/vendors/normalize.min.css")}}" />
        <link rel="stylesheet" href="{{asset("styles/vendors/aos.css")}}" />
        <link rel="stylesheet" href="{{asset("styles/vendors/bootstrap.css")}}">
        <link rel="stylesheet" href="{{asset("styles/vendors/lightbox.min.css")}}">
        <link rel="stylesheet" href="{{asset("styles/styles.css")}}">
        <script src="{{asset("scripts/vendors/axios.min.js")}}"></script>
        <script src="{{asset("scripts/vendors/sweetalert2.all.min.js")}}"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="{{asset("favicon.png")}}" type="image/png">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
        <title>@yield("title")</title>
    </head>
    <body style="overflow-y: hidden;">
        @include("components.loaders.loader")
        @yield("body")
        
        <script src="{{asset("scripts/vendors/jquery-3.3.1.slim.min.js")}}" ></script>
        <script src="{{asset("scripts/vendors/popper.min.js")}}"></script>
        <script src="{{asset("scripts/vendors/lightbox-plus-jquery.min.js")}}" ></script>
        <script src="{{asset("scripts/vendors/lightbox.min.js")}}"></script>
        <script src="{{asset("scripts/vendors/bootstrap.js")}}"></script>
        <script src="{{asset("scripts/vendors/polyfill.js")}}"></script>
        <script src="{{asset("scripts/vendors/aos.js")}}"></script>
        <script src="{{asset("scripts/js/helpers/darkMode.js")}}"></script>
        <script src="https://kit.fontawesome.com/7d7cc578e0.js" crossorigin="anonymous"></script>
        <script src="{{asset("scripts/script.js")}}" type="module"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>
