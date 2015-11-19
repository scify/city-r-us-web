@extends('template.default')
@section('title')
Προβολή αποστολής
@stop
@section('pageTitle')
Προβολή αποστολής
@stop

@section('bodyContent')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="missionId" data-id="{{ $id }}" style="display:none;"></div>
                        @include('main.missions.partials._one')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('footerScripts')
<script src="{{ asset('/js/pages/missions/delete.js')}}"></script>
<script src="{{ asset('/js/pages/missions/one.js')}}"></script>
@append
