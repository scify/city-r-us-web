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
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Αποστολές</h4>
            </div>
            <div class="panel-body">
                @include('main.missions.partials._table')
            </div>
        </div>
    </div>
</div>

@stop
