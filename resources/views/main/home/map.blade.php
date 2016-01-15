@extends('template.public.default')

@section('title')
    Ο χάρτης της πόλης
@stop

@section('headerScripts')
    <link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/css/home/map.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('footerScripts')
    <link href="{{ asset('/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEahTQQgG0h61XN8n5LNS4NTx5NsbWaXg&callback="></script>
    <script src="{{ asset('/plugins/googleMapsOverlappingMarker/oms.min.js')}}"></script>
    <script src="{{ asset('/plugins/googleMapsMarkerClusterer/markerclusterer.js')}}"></script>
    <script src="{{ asset('/js/pages/home/activityonmap.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({autoclose: true, format: 'dd/mm/yyyy', clearBtn: true});

            var mapActivity = new scify.ActivityOnMap($("#map-container"),
                    $("#map-container").data("marker-icon"),
                    parseFloat($("#map-container").data("lat")),
                    parseFloat($("#map-container").data("long")),
                    parseFloat($("#map-container").data("zoom")),
                    $("#map-container").data("template-url"),
                    $("#map-container").data("city-events"),
                    $("#map-container").data("city-venues")
                    );

            mapActivity.init();

        });
    </script>
@stop

@section('bodyContent')
    @include('template.public.topBar',["navClass" => 'whiteHeader', "active" => "map"])

    <div id="map-section" data-url="{!! env('WEB_URL') !!}">
        <div id="pois-events">
            <div class="row">
                <a id="show-events" href="javascript:void(0)">Δράσεις στην περιοχή</a>
                <a id="hideEvents" class="hide" href="javascript:void(0)"><i class="glyphicon glyphicon-remove"></i></a>
            </div>


            <div class="row">
                <a id="show-pois" href="javascript:void(0)">Σημεία ενδιαφέροντος στην περιοχή</a>
                <a id="hidePoIs" class="hide"><i class="glyphicon glyphicon-remove"></i></a>
            </div>
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
                    <h1>Eπιλογή Περιόδου</h1>
                    <div id="period">
                        <form action="#">
                            <div class="datepick-wrapper">
                                Από:
                                <div id="from-date" class="input-group date datepicker">
                                    <input name="from" type="text" class="form-control">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="datepick-wrapper">
                                Έως:
                                <div id="to-date" class="input-group date datepicker">
                                    <input name="to" type="text" class="form-control">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Ανανέωση">
                        </form>
                    </div>
                @else
                    <div>
                        Συνέβει ένα λάθος κατά την φόρτωση αποστολών...
                    </div>
                @endif
            </div>
        </div>
        <div data-marker-icon=""
             data-lat="37.979725"
             data-long="23.710935"
             data-zoom ="12"
             data-template-url="{{ env('API_URL') }}/missions/{id}/observations"
             id="map-container"
             data-city-events = "{{action("HomeController@getEvents")}}"
             data-city-venues = "{{action("HomeController@getVenues")}}">
        </div>
    </div>

    <div class="loading"></div>
@stop
