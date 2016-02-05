@extends('template.default')

@section('title')
{{trans('admin_pages.editMission')}}
@stop

@section('pageTitle')
{{trans('admin_pages.editMission')}}
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
                    @if ($mission!=null)
                    <div class="col-md-12">
                        {!! Form::model($mission, ['method' => 'POST', 'action' => ['MissionController@update', 'id' => $mission->id], 'id' => 'editMission', 'files'=>true]) !!}
                        @include('main.missions.partials._form', ['mission' => $mission])
                        {!! Form::hidden('id', $mission->id, ['id' => 'mission_id']) !!}
                        {!! Form::close() !!}
                    </div>
                    @else
                    <div class="col-sm-12 col-md-12">
                        <p>{{ trans('admin_pages.missionNotFound') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('footerScripts')
<script src="{{ asset('/js/pages/missions/edit.js')}}"></script>
@append
