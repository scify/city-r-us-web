@extends('template.default')

@section('title')
{{trans('admin_pages.createMission')}}
@stop

@section('pageTitle')
{{trans('admin_pages.createMission')}}
@stop

@section('bodyContent')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">{{ trans('admin_pages.missionDetails') }}</h4>

                <div class="panel-control">
                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title=""
                       class="panel-collapse" data-original-title="Expand/Collapse"><i class="icon-arrow-down"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['method' => 'POST', 'action' => 'MissionController@store', 'id' =>
                        'createMission', 'files'=>true]) !!}
                        @include('main.missions.partials._form')
                        {!! Form::hidden('id', null, ['id' => 'mission_id']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('footerScripts')
<script src="{{ asset('messages.js')}}"></script>
<script>
    Lang.setLocale('el');
    msg = Lang.has('messages.el.passwords.password');
    console.log(msg);
</script>
<script src="{{ asset('/js/pages/missions/create.js')}}"></script>
@append

