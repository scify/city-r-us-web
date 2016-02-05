  <nav id="header" class="navbar {{$navClass}}">
              <div class="container">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="fa fa-bars"></span>
                      </button>
                      <a class="navbar-brand" href="{{ url('/') }}">City-R-US</a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse navbar-right">
                      <ul class="nav navbar-nav">

                           <li {{ $active=="home" ? 'class=active' : ''}}><a href="{{ url('/') }}">{{trans('home_default.home')}}</a></li>
                           <li {{ $active=="map" ? 'class=active' : ''}}><a href="{{action("HomeController@citymap")}}">{{trans('home_default.viewMap')}}</a></li>
                      </ul>
                  </div>
              </div>
          </nav>


