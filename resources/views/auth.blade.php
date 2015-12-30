<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <!-- Bootstrap 3.3.5 -->
        <link href="{!! load_asset('/components/admin/bootstrap/css/bootstrap.css') !!}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Theme style -->
        <link href="{!! load_asset('/components/admin/dist/css/admin.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! load_asset('/components/admin/plugins/icheck/square/blue.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! load_asset('/css/app.css') !!}" rel="stylesheet" type="text/css" />
    </head>
    <body class="login-page">
        <section class="content">
            @yield('content')
        </section>
        <script src="{{ load_asset ('/components/admin/plugins/jQuery/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ load_asset ('/components/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ load_asset ('/components/admin/plugins/icheck/icheck.min.js') }}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '5%'
                });
            });
        </script>
    </body>
</html>
