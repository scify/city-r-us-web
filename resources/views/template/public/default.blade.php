<!DOCTYPE html>
<html>
<head>
        <title> @yield('title') | {{trans('/default.title')}}</title>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,400,300' rel='stylesheet' type='text/css'>
        <link href="{{ asset('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>

        @yield('headerScripts')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
       @yield('bodyContent')



       <script src="{{ asset('/plugins/jquery/jquery-2.1.3.min.js')}}"></script>
       <script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
       @yield('footerScripts')
    </body>
</html>

