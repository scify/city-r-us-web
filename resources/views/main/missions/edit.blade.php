@extends('template.default')

@section('title')
Επεξεργασία Αποστολής
@stop

@section('pageTitle')
Επεξεργασία Αποστολής
@stop

@section('bodyContent')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Στοιχεία αποστολής</h4>

                <div class="panel-control">
                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title=""
                       class="panel-collapse" data-original-title="Expand/Collapse"><i class="icon-arrow-down"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::model($mission, ['method' => 'POST', 'action' => ['MissionController@update', 'id' => $mission->id]]) !!}
                        @include('main.missions.partials._form', ['submitButtonText' => 'Αποθήκευση', 'mission' => $mission])
                        {!! Form::close() !!}
                        {!! Form::hidden('mission_id', $mission->id, ['id' => 'mission_id']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

