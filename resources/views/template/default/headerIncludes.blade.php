        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template"/>
        <meta name="keywords" content="admin,dashboard"/>
        <meta name="author" content="Steelcoders"/>
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta name="apiUrl" content="http://city-r-us-service/api/v1" />
        <meta name="url" content="http://city-r-us-web" />

        <link rel="icon" type="image/png" href="{{ asset('favicon.ico')}}">


        <!-- Styles -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="{{ asset('/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
        <link href="{{ asset('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/line-icons/simple-line-icons.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/waves/waves.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/slidepushmenus/css/component.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="{{ asset('/css/modern.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/css/themes/blue.css')}}" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/css/custom.css')}}" rel="stylesheet" type="text/css"/>


        <script src="{{ asset('/plugins/3d-bold-navigation/js/modernizr.js')}}"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        {{--[if lt IE 9]>--}}
        {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>--}}
        {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
        {{--<![endif]--}}
