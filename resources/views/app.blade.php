<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="http://keenthemes.com/preview/metronic/theme/assets/global/css/components.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout/css/layout.min.css" rel="stylesheet" />
    <link href="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout/css/custom.min.css"  />
</head>
<body class="page-container-bg-solid page-content-white">
<div class="page-container" id="app">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="margin: 0;">
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('metronic/plugins/jquery-slimscroll/jquery-slimscroll.min.js') }}"></script>
<script src="http://keenthemes.com/preview/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="http://keenthemes.com/preview/metronic/theme/assets/global/scripts/app.min.js"></script>
</body>
</html>