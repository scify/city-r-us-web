  <nav id="header" class="navbar {{$navClass}}">
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

                        @if( $active=="home")
                           <li class="active"><a href="#home">Αρχική</a></li>
                           <li ><a href="{{action("HomeController@citymap")}}">Δες τον χάρτη</a></li>
                        @else
                           <li><a href="{{ action("HomeController@index") }}">Αρχική</a></li>
                           <li class="active" ><a href="{{action("HomeController@citymap")}}">Δες τον χάρτη</a></li>
                        @endif
                      </ul>
                  </div>
              </div>
          </nav>


