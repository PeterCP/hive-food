<!DOCTYPE html>
<html lang="es" class="no-js">
<!-- HEAD -->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hive Food</title>
    <meta name="keywords" content="Hive Food" />
    <meta name="description" content="Hive Food">
    <meta name="author" content="ricardofabila.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,400,700,500,300,300italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="{{ URL::asset('theme/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('theme/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('theme/plugins/et-line/et-line.css') }}" rel="stylesheet" type="text/css"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME PLUGINS STYLE -->
    <!-- END THEME PLUGINS STYLE -->

    <!-- THEME STYLES -->
    <link href="{{ URL::asset('theme/css/global.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <!-- THEME -->
    <link href="{{ URL::asset('theme/css/theme/dark.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME -->

    <!-- BEGIN JQUERY -->
    <script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.min.js') }}"></script>
    <!-- END JQUERY -->

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ URL::asset('theme/favicon.ico') }}"/>
    <!-- END FAVICON -->


    <!-- Styles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    -->
</head>
<!-- END HEAD -->

<body>

@yield('content')

<!--========== JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) ==========-->
<!-- CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{ URL::asset('theme/plugins/html5shiv.js') }}"></script>
<script src="{{ URL::asset('theme/plugins/respond.min.js') }}"></script>
<![endif]-->
<script type="text/javascript" src="{{ URL::asset('theme/plugins/jquery.migrate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('theme/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- END CORE PLUGINS -->

@yield('pages-plugins')
@yield('pages-scripts')
<!--========== END JAVASCRIPTS ==========-->

</body>
</html>
