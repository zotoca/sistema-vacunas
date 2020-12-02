<!DOCTYPE html>
<html lang="es-VE">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="{{asset("styles/normalize.min.css")}}" />
        <link rel="stylesheet" href="{{asset("styles/aos.css")}}" />
        <link rel="stylesheet" href="{{asset("styles/bootstrap.css")}}">
        <link rel="stylesheet" href="{{asset("styles/styles.css")}}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="shortcut icon" href="{{asset("favicon.png")}}" type="image/png">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
        <title>@yield("title")</title>
    </head>
    <body>

        @yield("body")
        
        <script src="{{asset("scripts/jquery-3.3.1.slim.min.js")}}" ></script>
        <script src="{{asset("scripts/popper.min.js")}}"></script>
        <script src="{{asset("scripts/bootstrap.js")}}"></script>
        <script src="{{asset("scripts/polyfill.js")}}"></script>
        <script src="{{asset("scripts/sweetalert.min.js")}}"></script>
        <script src="{{asset("scripts/aos.js")}}"></script>
        <script src="https://kit.fontawesome.com/7d7cc578e0.js" crossorigin="anonymous"></script>
        <script src="{{asset("scripts/script.js")}}" type="module"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>