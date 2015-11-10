@extends('template.default')

@section('title')
Δημιουργία Αποστολής
@stop

@section('pageTitle')
Δημιουργία Αποστολής
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
                        {!! Form::open(['method' => 'POST',  'id' => 'createMission']) !!}
                        @include('main.missions.partials._form', ['submitButtonText' => 'Αποθήκευση'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('footerScripts')
<script src="{{ asset('/js/pages/missions/create.js')}}"></script>
@append
