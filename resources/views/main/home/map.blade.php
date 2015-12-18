@extends('template.public.default')

@section('title')
 Ο χάρτης της πόλης
@stop

@section('headerScripts')
 <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('/css/home/map.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('footerScripts')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEahTQQgG0h61XN8n5LNS4NTx5NsbWaXg&callback="></script>
  <script src="{{ asset('/plugins/googleMapsOverlappingMarker/oms.min.js')}}"></script>
  <script src="{{ asset('/js/activityonmap.js')}}"></script>
  <script src="{{ asset('/js/pages/home/map.js')}}"></script>
@stop

@section('bodyContent')
       @include('template.public.topBar',["navClass" => 'whiteHeader', "active" => "map"])



<div id="map-section">
    <div id="pois-events">
        <a id="show-events" href="javascript:void(0)">δείτε δράσεις στην περιοχή</a>
        <a id="show-pois" href="javascript:void(0)">δείτε σημεία ενδιαφέροντος στην περιοχή</a>
    </div>
    <div id="map-filter">
      <div id="filters">
           <h1>Eπιλογή αποστολής</h1>
           @if ($missions->status=="success")
           <div id="missions">
            @foreach($missions->message->missions as $m)
               <div data-id="{{ $m->id }}" data-type="{{ $m->type_id }}" class="mission" title="{{ $m->description }}">{{ $m->name }}</div>
            @endforeach
           </div>
           @else
           <div>
            Συνέβει ένα λάθος κατά την φόρτωση αποστολών...
           </div>
           @endif

       </div>
    </div>
    <div data-marker-team="http://wp12464876.server-he.de/mod/scify/images/marker_new_teams.png"
         data-lat="37.979725"
         data-long="23.710935"
         data-zoom ="12"
         data-template-url="{{ url('/') }}/missions/{id}/observations"
         id="map-container">
     </div>
</div>
@stop
