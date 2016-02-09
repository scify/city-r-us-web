@extends('template.default')
@section('title')
{{trans('admin_pages.home')}}
Αρχική
@stop

@section('bodyContent')
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="panel info-box panel-white">
            <div class="panel-body">
                <div class="info-box-stats">
                    <p class="counter">{{ $missions }}</p>
                    <span class="info-box-title">{{trans_choice('admin_pages.missions', $missions)}}</span>
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
                    <span class="info-box-title">{{trans_choice('admin_pages.users', $users)}}</span>
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
                    <span class="info-box-title">{{trans_choice('admin_pages.observations', $observations)}}</span>
                </div>
                <div class="info-box-icon">
                    <i class="fa fa-map-marker"></i>
                </div>
            </div>
        </div>
    </div>
</div>



@stop
