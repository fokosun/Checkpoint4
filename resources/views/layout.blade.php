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
      <link href="{!! load_asset('/components/admin/dist/css/admin.css') !!}" rel="stylesheet" type="text/css" />
      <link href="{!! load_asset('/components/admin/dist/css/skins/_all_skins.min.css') !!}" rel="stylesheet" type="text/css" />
      <link href="{!! load_asset('/css/app.css') !!}" rel="stylesheet" type="text/css" />
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="row">
            @include('header')
            <div class="content-wrapper">
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>
        <script src="{{ load_asset ('/components/admin/plugins/jQuery/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ load_asset ('/components/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ load_asset ('/components/admin/plugins/fastclick/fastclick.js') }}"></script>
        <script src="{{ load_asset ('/components/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ load_asset ('/components/admin/dist/js/app.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ load_asset ('/components/admin/plugins/sparkline/jquery.sparkline.min.js') }}">
        </script>
        <!-- jvectormap -->
        <script src="{{ load_asset ('/components/admin/plugins/jvectormap/jvectormap.min.js') }}">
        </script>
        <script src="{{ load_asset ('/components/admin/plugins/jvectormap/jvectormap_world_mill_en.js') }}">
        </script>
        <!-- SlimScroll 1.3.0 -->
        <script src="{{ load_asset ('/components/admin/plugins/slimScroll/slimscroll.min.js') }}">
        </script>
        <!-- ChartJS 1.0.1 -->
        <script src="{{ load_asset ('/components/admin/plugins/chartjs/Chart.min.js') }}">
        </script>
        <script src="{{ load_asset ('/components/admin/dist/js/pages/dashboard2.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ load_asset ('/components/admin/dist/js/demo.js') }}"></script>
    </body>
</html>
