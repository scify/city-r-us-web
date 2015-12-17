@extends('template.public.default')

@section('title')
 Ο χάρτης της πόλης
@stop

@section('headerScripts')
 <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('/css/home/map.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('footerScripts')
  <script src="{{ asset('/js/pages/home/map.js')}}"></script>
@stop

@section('bodyContent')
       @include('template.public.topBar',["navClass" => 'whiteHeader', "active" => "map"])

          <div class="map-controls">

          </div>
          <div class="map-container">

           </div>

          <footer>
              <div class="container">
                  <p class="text-center no-s">2015 &copy; SciFY | <a href="https://commons.wikimedia.org/wiki/File:Athens_-_Monastiraki_square_and_station_-_20060508.jpg" target="_blank">Πηγή εικόνας background</a></p>
              </div>
          </footer>
@stop
