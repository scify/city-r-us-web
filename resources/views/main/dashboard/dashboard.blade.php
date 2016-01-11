@extends('template.default')
@section('title')
Αρχική
@stop
@section('pageTitle')
Αρχική
@stop

@section('bodyContent')
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="panel info-box panel-white">
            <div class="panel-body">
                <div class="info-box-stats">
                    <p class="counter">{{ $missions }}</p>
                    <span class="info-box-title">{{ $missions==1 ? 'Αποστολή' : 'Αποστολές' }}</span>
                </div>
                <div class="info-box-icon">
                    <i class="fa fa-bullseye"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel info-box panel-white">
            <div class="panel-body">
                <div class="info-box-stats">
                    <p class="counter">{{ $users }}</p>
                    <span class="info-box-title">{{ $users==1 ? 'Χρήστης' : 'Χρήστες' }}</span>
                </div>
                <div class="info-box-icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel info-box panel-white">
            <div class="panel-body">
                <div class="info-box-stats">
                    <p class="counter">{{ $observations }}</p>
                    <span class="info-box-title">{{ $observations==1 ? 'Παρατήρηση' : 'Παρατηρήσεις' }}</span>
                </div>
                <div class="info-box-icon">
                    <i class="fa fa-map-marker"></i>
                </div>
            </div>
        </div>
    </div>
</div>



@stop
