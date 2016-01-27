@extends('template.default')

@section('title')
Χρήστες
@stop

@section('headerScripts')
<link href="{{ asset('/css/users/users.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('footerScripts')
<script src="{{ asset('/js/pages/users/send_mail.js')}}"></script>
@stop

@section('pageTitle')
Χρήστες
@stop

@section('bodyContent')

@include('main.users.partials._filters')
@include('main.users.partials._list')

@stop

@section('footerScripts')
@append