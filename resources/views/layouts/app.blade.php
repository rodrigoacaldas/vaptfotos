<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />


    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#49CEFF">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#49CEFF" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>VF - CRM</title>
    <link rel="icon" href="/vendor/img/favicon.png" />
    <link rel="stylesheet" href="/vendor/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/animate.css/animate.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/metisMenu/dist/metisMenu.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="/vendor/bower_components/Waves/dist/waves.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/toastr/toastr.css">

    <link rel="stylesheet" href="/vendor/css/style.css">


    @yield('scriptshead')
</head>

<body class="fixed-sidebar">

    <div class="wrapper">
        <!-- barra de cima -->
        @include('layouts.header')

        <!-- barra lateral -->
        @include('layouts.sidebar')

        <div class="container-fluid">
            @include('layouts.alertas')
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

    <script src="/vendor/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/vendor/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="/vendor/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js"></script>
    <script src="/vendor/bower_components/Waves/dist/waves.min.js"></script>
    <script src="/vendor/bower_components/toastr/toastr.js"></script>

    <script src="/vendor/js/common.js"></script>
    @yield('scriptsfoot')

</body>
</html>