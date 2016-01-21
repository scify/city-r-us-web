@extends('template.public.default')

@section('title')
    Αρχική
@stop

@section('headerScripts')
    <link href="{{ asset('plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/plugins/tabstylesinspiration/css/tabs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/plugins/tabstylesinspiration/css/tabstyles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/home/landing.css') }}" rel="stylesheet" type="text/css"/>
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
                <a href="{{ action("AdminController@index") }}" class="admin-entry btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Περιβάλλον Διαχειριστή</a>
                <div class="home-text col-md-8">
                    <h1 class="wow fadeInDown" data-wow-delay="1.5s" data-wow-duration="1.5s" data-wow-offset="10">Η πόλη είμαστε εμείς!</h1>
                    <p class="lead wow fadeInDown" data-wow-delay="2s" data-wow-duration="1.5s" data-wow-offset="10">
                    Πάρε μέρος σε αποστολές στην Αθήνα <br>Βελτίωσε την πόλη σου</p>
                    <a href="https://play.google.com/apps/testing/gr.scify.cityrus" target="_blank" class="btn btn-default btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Κατέβασε την εφαρμογή</a>
                    <a href="{{ action("HomeController@citymap") }}" target="_blank" class="btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Χάρτης με αποτελέσματα</a>
                </div>
                <div class="scroller">
                    <div class="mouse"><div class="wheel"></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="features">
        <div class="row features-list">
            <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">
                <div class="feature-icon">
                    <i class="fa fa-flag"></i>
                </div>
                <h2>Βρες αποστολές</h2>
                <p>Ο Δήμος τις Αθήνας προτείνει αποστολές για να βελτιώσουμε την πόλη.</p>

            </div>
            <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.7s">
                <div class="feature-icon">
                    <i class="fa fa-map-marker"></i>
                </div>
                <h2>Ανέβασε διαδρομή</h2>
                <p>Μπορείς να συνεισφέρεις σ'ενα δημόσιο χάρτη, στέλνοντας είτε ενα σημείο ή μια διαδρομή (ανάλογα με την αποστολή)</p>

            </div>
            <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.9s">
                <div class="feature-icon">
                    <i class="fa fa-globe"></i>
                </div>
                <h2>Δες τον χάρτη της πόλης</h2>
                <p>Η συνεισφορά όλων των πολιτών φαίνεται σένα δημόσιο χάρτη. Κλικ <a href="/map">εδώ </a></p>

            </div>
        </div>
    </div>
    <section id="section-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                    <img src="{{ asset('img/home/cityrus-mobileapp.png') }}" class="iphone-img" alt="">
                </div>
                <div class="col-sm-8 wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                    <h1>Λίγα λογια για την εφαρμογή</h1>
                    <p>Το City-R-US ειναι μια εφαρμογή που επιτρέπει στους κατοίκους της Αθήνας να συμμετέχουν σε αποστολές.
                       Επίλεξε την αποστολή που σε ενδιαφέρει και βοήθησε τη πόλη σου!
                       Τα δεδομένα των αποστολών συλλέγονται σ'έναν δημόσιο χάρτη διαθέσιμο <a href="/map">εδώ</a></p>
                    <ul class="list-unstyled features-list-2">
                        <li><i class="fa fa-diamond icon-state-success m-r-xs icon-md"></i>Μοντέρνα αισθητική</li>
                        <li><i class="fa fa-check icon-state-success m-r-xs icon-md"></i>Μπορείς να προτείνεις κ εσύ αποστολές!</li>
                        <li><i class="fa fa-cogs icon-state-success m-r-xs icon-md"></i>Επιβράβευση των πολιτών που συνεισφέρουν περισσότερο</li>
                        <li><i class="fa fa-cloud icon-state-success m-r-xs icon-md"></i>Εύκολο στη χρήση του</li>
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
                                        <p class="text-white">Πολύ καλή ιδέα!<br> Θα είναι εξαιρετικό να έχουμε χαρτογραφημένα σημεία και διαδρομές που είναι προσβάσιμες από ΑμεΑ στην πόλη.<br> Πείτε μου πως να βοηθήσω.</p>
                                        <span>Dr. Γιώργος Χρηστάκης
                                               <br>Χορογράφος, <br>χορευτής σε αναπ.αμαξίδιο, <br>ιδρυτής του Χοροθεάτρου ΔΑΓΙΠΟΛΗ</span>
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
                    <h2>Πρότεινε μια αποστολή</h2>
                    <form class="m-t-md">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control input-lg contact-name" placeholder="Όνομα">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control input-lg" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="4=6" placeholder="Θα σας πρότεινα να..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-default btn-lg">Aποστολή</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <p class="text-center no-s">2015 &copy; SciFY | <a href="https://commons.wikimedia.org/wiki/File:Athens_-_Monastiraki_square_and_station_-_20060508.jpg" target="_blank">Πηγή εικόνας background</a></p>
        </div>
    </footer>
@stop








