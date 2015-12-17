<!DOCTYPE html>
<html>
<head>
        <title>City-R-US | Ο χάρτης της πόλης</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,400,300' rel='stylesheet' type='text/css'>

        <link href="{{ asset('plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
        <link href="{{ asset('/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
        <link href="{{ asset('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
       <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
       <link href="{{ asset('/css/home/map.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ asset('/plugins/pricing-tables/js/modernizr.js') }}"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body data-spy="scroll" data-target="#header">
           @include('template.public.topBar',["navClass" => 'whiteHeader'])

          <div class="map-controls">

          </div>
          <div class="map-container">

           </div>

          <footer>
              <div class="container">
                  <p class="text-center no-s">2015 &copy; SciFY | <a href="https://commons.wikimedia.org/wiki/File:Athens_-_Monastiraki_square_and_station_-_20060508.jpg" target="_blank">Πηγή εικόνας background</a></p>
              </div>
          </footer>

         <script src="{{ asset('/plugins/jquery/jquery-2.1.3.min.js')}}"></script>
         <script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
         <script src="{{ asset('/js/pages/home/map.js')}}"></script>

      </body>
</html>