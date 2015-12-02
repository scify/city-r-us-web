<!DOCTYPE html>
<html>
<head>
        <title>City-R-US | Η πόλη είμαστε εμείς!</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        {{--<meta name="description" content="Modern Landing Page" />--}}
        {{--<meta name="keywords" content="landing" />--}}
        {{--<meta name="author" content="Steelcoders" />--}}

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,400,300' rel='stylesheet' type='text/css'>

        <link href="{{ asset('plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
        <link href="{{ asset('/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
        <link href="{{ asset('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/fontawesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/plugins/tabstylesinspiration/css/tabs.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/plugins/tabstylesinspiration/css/tabstyles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/home/landing.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ asset('/plugins/pricing-tables/js/modernizr.js') }}"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body data-spy="scroll" data-target="#header">
          <nav id="header" class="navbar navbar-fixed-top">
              <div class="container">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="fa fa-bars"></span>
                      </button>
                      <a class="navbar-brand" href="#">City-R-US</a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse navbar-right">
                      <ul class="nav navbar-nav">
                          <li><a href="#home">Αρχική</a></li>
                          <li><a href="/">Δες τον χάρτη</a></li>

                      </ul>
                  </div>
              </div>
          </nav>

          <div class="home" id="home">
              <div class="overlay"></div>
              <div class="container">
                  <div class="row">
                      <div class="home-text col-md-8">
                          <h1 class="wow fadeInDown" data-wow-delay="1.5s" data-wow-duration="1.5s" data-wow-offset="10">Η πόλη είμαστε εμείς!</h1>
                          <p class="lead wow fadeInDown" data-wow-delay="2s" data-wow-duration="1.5s" data-wow-offset="10">
                          Πάρε μέρος σε αποστολές στην Αθήνα <br>Βελτίωσε την πόλη σου</p>
                          <a href="https://play.google.com/apps/testing/gr.scify.cityrus" target="_blank" class="btn btn-default btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Κατέβασε την εφαρμογή</a>
                          <a href="#" target="_blank" class="btn btn-success btn-rounded btn-lg wow fadeInUp" data-wow-delay="2.5s" data-wow-duration="1.5s" data-wow-offset="10">Χάρτης με αποτελέσματα</a>
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
                          <i class="fa fa-laptop"></i>
                      </div>
                      <h2>Βρες αποστολές</h2>
                      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies</p>
                      <p><a class="btn btn-link" href="#" role="button">View details &raquo;</a></p>
                  </div>
                  <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.7s">
                      <div class="feature-icon">
                          <i class="fa fa-lightbulb-o"></i>
                      </div>
                      <h2>Ανέβασε διαδρομή</h2>
                      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies</p>
                      <p><a class="btn btn-link" href="#" role="button">View details &raquo;</a></p>
                  </div>
                  <div class="col-sm-4 wow fadeInLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.9s">
                      <div class="feature-icon">
                          <i class="fa fa-support"></i>
                      </div>
                      <h2>Δες τον χάρτη της πόλης</h2>
                      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies</p>
                      <p><a class="btn btn-link" href="#" role="button">View details &raquo;</a></p>
                  </div>
              </div>
          </div>
          <section id="section-1">
              <div class="container">
                  <div class="row">
                      <div class="col-sm-4 wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                          <img src="{{ asset('img/home/iphone.png') }}" class="iphone-img" alt="">
                      </div>
                      <div class="col-sm-8 wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                          <h1>Λίγα λογια για την εφαρμογή</h1>
                          <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero.</p>
                          <ul class="list-unstyled features-list-2">
                              <li><i class="fa fa-diamond icon-state-success m-r-xs icon-md"></i>Unique design</li>
                              <li><i class="fa fa-check icon-state-success m-r-xs icon-md"></i>Everything you need</li>
                              <li><i class="fa fa-cogs icon-state-success m-r-xs icon-md"></i>Tons of features</li>
                              <li><i class="fa fa-cloud icon-state-success m-r-xs icon-md"></i>Easy to use &amp; customize</li>
                          </ul>
                      </div>
                  </div>
              </div>
          </section>
          <section id="section-2">
              <div class="container">
                  <div class="row">
                      <div class="col-sm-8 wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                          <section>
                              <div class="tabs tabs-style-linebox">
                                  <nav>
                                      <ul>
                                          <li class="tab-current"><a href=""><span>Responsive</span></a></li>
                                          <li class=""><a href=""><span>Browsers</span></a></li>
                                          <li class=""><a href=""><span>Bootstrap</span></a></li>
                                          <li class=""><a href=""><span>Icons</span></a></li>
                                          <li class=""><a href=""><span>Documentation</span></a></li>
                                      </ul>
                                  </nav>
                                  <div class="content-wrap">
                                      <section class="content-current">
                                          <h1>Πρότεινε μια αποστολή</h1>
                                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.<br>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p></section>
                                      <section><p>
                                          <h1>Cross-browser Compatible</h1>
                                          <p>Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.<br>Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p></section>
                                      <section><p>
                                          <h1>Built With Bootstrap 3.3.4</h1>
                                          <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc.</p></section>
                                      <section><p>
                                          <h1>+1100 Icons Included</h1>
                                          <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis.<br>Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam.</p></section>
                                      <section><p>
                                          <h1>Well Documented</h1>
                                          <p>Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligula. Fusce fermentum. Nullam cursus lacinia erat. Praesent blandit laoreet nibh.</p></section>
                                  </div>
                              </div>
                          </section>
                      </div>
                      <div class="col-sm-4 wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-offset="10">
                          <img src="assets/images/iphone2.png" class="iphone-img" alt="">
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
                                  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                  <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                              </ol>
                              <div class="carousel-inner" role="listbox">
                                  <div class="item active">
                                      <div class="row">
                                          <div class="col-sm-6 col-sm-offset-3">
                                              <p class="text-white">â€œAenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero.â€</p>
                                              <span>- David, App Manager</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="item">
                                      <div class="row">
                                          <div class="col-sm-6 col-sm-offset-3">
                                              <p class="text-white">â€œLorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.â€</p>
                                              <span>- Sandra, Director</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="item">
                                      <div class="row">
                                          <div class="col-sm-6 col-sm-offset-3">
                                              <p>â€œCurabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit.â€</p>
                                              <span>- Amily, UI Designer</span>
                                          </div>
                                      </div>
                                  </div>
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
                          <h2>Let's keep in touch</h2>
                          <form class="m-t-md">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control input-lg contact-name" placeholder="Name">
                                      </div>
                                      <div class="col-sm-6">
                                          <input type="email" class="form-control input-lg" placeholder="Email">
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control input-lg" placeholder="Subject">
                              </div>
                              <div class="form-group">
                                  <textarea class="form-control" rows="4=6" placeholder="Message"></textarea>
                              </div>
                              <button type="submit" class="btn btn-default btn-lg">Send Message</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <footer>
              <div class="container">
                  <p class="text-center no-s">2015 &copy; Modern by Steelcoders.</p>
              </div>
          </footer>


         <script src="{{ asset('/plugins/jquery/jquery-2.1.3.min.js')}}"></script>
         <script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
         <script src="{{ asset('/plugins/pace-master/pace.min.js')}}"></script>
         <script src="{{ asset('/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
         <script src="{{ asset('/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
         <script src="{{ asset('/plugins/uniform/jquery.uniform.min.js')}}"></script>
         <script src="{{ asset('/plugins/wow/wow.min.js')}}"></script>
         <script src="{{ asset('/plugins/smoothscroll/smoothscroll.js')}}"></script>
         <script src="{{ asset('/plugins/tabstylesinspiration/js/cbpfwtabs.js')}}"></script>
         <script src="{{ asset('/plugins/pricing-tables/js/main.js')}}"></script>
         <script src="{{ asset('/js/landing.js')}}"></script>

      </body>
</html>