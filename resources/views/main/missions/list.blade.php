@extends('template.default')
@section('title')
Αποστολές
@stop
@section('pageTitle')
Αποστολές
@stop

@section('bodyContent')

<div class="row">
    <div class="col-md-12">
        @include('main.missions.partials._all')
    </div>
</div>

@stop

@section('footerScripts')
<script src="{{ asset('/js/pages/missions/all.js')}}"></script>
@append
