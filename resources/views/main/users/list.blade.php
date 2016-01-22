@extends('template.default')
@section('title')
Χρήστες
@stop
@section('pageTitle')
Χρήστες
@stop

@section('bodyContent')

<div class="row">
    <div class="col-md-3">
        @include('main.users.partials._filters')
    </div>
    <div class="col-md-9">
        @include('main.users.partials._list')
    </div>
</div>

@stop

@section('footerScripts')
@append