<!DOCTYPE html>
<html lang="en">

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

    <title>Pacificonis - Login</title>
    <link rel="stylesheet" href="/vendor/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/animate.css/animate.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/metisMenu/dist/metisMenu.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="/vendor/bower_components/Waves/dist/waves.min.css">
    <link rel="stylesheet" href="/vendor/bower_components/toastr/toastr.css">
    <link rel="stylesheet" href="/vendor/css/style.css">

</head>

<body class="user-page">

    <div class="wrapper warning-bg">
        <div class="table-wrapper text-center">
            <div class="table-row">
                <div class="table-cell">
                    <div class="login">
                        <h4 class="text-center">Faça o login</h4>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input id="email" type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" placeholder="Senha" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group text-left">
                                <div class="checkbox checkbox-primary">
                                    <label><input type="checkbox">
                                        <i></i></label>
                                    <span class="white f-s-16 m-l-5">Lembrar-me</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-lg btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="/vendor/bower_components/jquery/dist/jquery.min.js"></script>

</body>
</html>
