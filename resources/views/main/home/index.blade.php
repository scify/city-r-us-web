@extends('template.public.default')

@section('title')
{{ trans('home_default.home') }}
@stop

@section('headerScripts')
    <link href="{{ asset('plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/plugins/tabstylesinspiration/css/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/plugins/tabstylesinspiration/css/tabstyles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/home/landing.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/plugins/pricing-tables/js/modernizr.js') }}"></script>
@stop

@section('footerScripts')
    <script src="{{ asset('/plugins/pace-master/pace.min.js')}}"></script>
    <script src="{{ asset('/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('/plugins/uniform/jquery.uniform.min.js')}}"></script>
    <script src="{{ asset('/plugins/wow/wow.min.js')}}"></script>
    <script src="{{ asset('/plugins/smoothscroll/smoothscroll.js')}}"></script>
    <script src="{{ asset('/plugins/tabstylesinspiration/js/cbpfwtabs.js')}}"></script>
    <script src="{{ asset('/plugins/pricing-tables/js/main.js')}}"></script>
    <script src="{{ asset('/js/pages/home/landing.js')}}"></script>
@stop

@section('bodyContent')
    @include('template.public.topBar',["navClass" => 'navbar-fixed-top', "active" => "home"])
    
    <div class="home" id="home">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="top-right-container">
                    <a href="{{ action("AdminController@index") }}" class="admin-entry btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">{{ trans('home_default.adminInterface') }}</a>
                    @if (\Cookie::get('locale') === 'el')
                        <a href="{{ url("/en") }}" class="language btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">English <img src="{{ asset('img/flags/gb.svg') }}"/></a>
                    @else
                        <a href="{{ url("/el") }}" class="language btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Ελληνικά <img src="{{ asset('img/flags/gr.svg') }}"/></a>
                    @endif
                </div>
                <div class="home-text col-md-8">
                    <h1 class="wow fadeInDown" data-wow-delay="1.5s" data-wow-duration="1.5s" data-wow-offset="10">{{ trans('home_default.title') }}</h1>
                    <p class="lead wow fadeInDown" data-wow-delay="2s" data-wow-duration="1.5s" data-wow-offset="10">{!! trans('home_default.subtitle') !!}</p>
                    <a href="https://play.google.com/store/apps/details?id=gr.scify.cityrus" target="_blank" class="btn btn-default btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">{{ trans('home_default.download') }}</a>
                    <a href="{{ action("HomeController@citymap") }}" target="_blank" class="btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">{{ trans('home_default.map') }}</a>
                </div>
                <div class="scroller">
                    <div class="mouse"><div class="wheel"></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="features">
        <div class="row features-list">
            <a href="https://play.google.com/store/apps/details?id=gr.scify.cityrus" class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
                <div class="feature-icon">
                    <i class="fa fa-flag"></i>
                </div>
                {!! trans('home_default.feature1') !!}
            </a>
            <a href="https://play.google.com/store/apps/details?id=gr.scify.cityrus" class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.7s">
                <div class="feature-icon">
                    <i class="fa fa-map-marker"></i>
                </div>
                {!! trans('home_default.feature2') !!}
            </a>
            <a href="{{ action("HomeController@citymap") }}" target="_blank" class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.9s">
                <div class="feature-icon">
                    <i class="fa fa-globe"></i>
                </div>
                {!! trans('home_default.feature3') !!}
            </a>
        </div>
    </div>
    <section id="section-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                    <img src="{{ asset('img/home/cityrus-mobileapp.png') }}" class="iphone-img" alt="">
                </div>
                <div class="col-sm-8 wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                    <h1>{{ trans('home_default.fewWords') }}</h1>
                    {!! trans('home_default.subFewWords', [
                    'link' => '<a href="'.url('/city-map').'" target="_blank">εδώ</a>'
                    ]) !!}

                    <ul class="list-unstyled features-list-2">
                        <li><i class="fa fa-diamond icon-state-success m-r-xs icon-md"></i>{{ trans('home_default.list1') }}</li>
                        <li><i class="fa fa-check icon-state-success m-r-xs icon-md"></i>{{ trans('home_default.list2') }}</li>
                        <li><i class="fa fa-cogs icon-state-success m-r-xs icon-md"></i>{{ trans('home_default.list3') }}</li>
                        <li><i class="fa fa-cloud icon-state-success m-r-xs icon-md"></i>{{ trans('home_default.list4') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="section-3">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            {{--<li data-target="#carousel-example-generic" data-slide-to="1"></li>--}}
                            {{--<li data-target="#carousel-example-generic" data-slide-to="2"></li>--}}
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        {!! trans('home_default.testimonial1') !!}
                                    </div>
                                </div>
                            </div>
                            {{--<div class="item">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-6 col-sm-offset-3">--}}
                                        {{--<p class="text-white">â€œLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.â€</p>--}}
                                        {{--<span>- Sandra, Director</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="item">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-6 col-sm-offset-3">--}}
                                        {{--<p>â€œCurabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit.â€</p>--}}
                                        {{--<span>- Amily, UI Designer</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 wow rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
                    <a href="#contact" class="btn btn-success btn-lg btn-rounded contact-button"><i class="fa fa-envelope-o"></i></a>
                    <h2>{{ trans('home_default.suggest') }}</h2>
                    <form class="m-t-md" action="#" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control input-lg contact-name" placeholder="{{ trans('home_default.name') }}">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="mail" class="form-control input-lg" placeholder="{{ trans('home_default.email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" rows="4=6" placeholder="{{ trans('home_default.iWouldSuggest') }}"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default btn-lg">{{ trans('home_default.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <p class="text-center no-s">2015 &copy; SciFY | <a href="{{ url('termsAndConditions') }}">{{ trans('home_default.termsAndConditions') }}</a> | <a href="https://commons.wikimedia.org/wiki/File:Athens_-_Monastiraki_square_and_station_-_20060508.jpg" target="_blank">{{ trans('home_default.imageSrc') }}</a></p>
        </div>
        <div class="container text-center">
            <p class=" no-s">{{ trans('home_default.funding') }}</p>
            <a href="http://www.radical-project.eu/" target="_blank"><img src="{{ asset('img/radical_logo.jpg') }}"></a>
            <img src="{{ asset('img/commission_europeenne_logo.jpg') }}">
        </div>
    </footer>
@stop
