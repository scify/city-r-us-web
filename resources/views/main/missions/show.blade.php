@extends('template.default')
@section('title')
Προβολή αποστολής
@stop
@section('pageTitle')
Προβολή αποστολής
@stop

@section('bodyContent')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="missionId" data-id="{{ $mission->id }}" style="display:none;"></div>
                        <div id="container"></div>

                        <div class="row">
                            @if ($mission!=null)
                            <div class="col-sm-3 col-md-3">
                                <div class="thumbnail">
                                    @if($mission->img_name!=null && $mission->img_name!='')
                                    <img src="{{ asset('/uploads/missions/'.$mission->img_name)}}"
                                         alt="{{$mission->name}}">
                                    @else
                                    <img src="{{ asset('/img/mission.png')}}"
                                         alt="{{$mission->name}}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9">
                                <div class="caption">
                                    <h3>{{ $mission->name }}</h3>

                                    <p>Τύπος: {{ $mission->type->name=='location' ? 'Καταγραφή σημείου στο χάρτη' : 'Διαδρομή' }}</p>

                                    <p>Ημερομηνία δημιουργίας: {{ \Carbon::parse($mission->created_at)->format('d/m/Y')
                                        }}</p>
                                    @if($mission->description!=null)
                                    <p>Περιγραφή: {{ $mission->description }}</p>
                                    @endif
                                    <p class="small text-right">12 contributors</p>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('/missions/edit/'.$mission->id) }}" class="btn btn-success">
                                        Επεξεργασία</a>
                                    <button onclick="destroyMission({{ $mission->id }})" class="btn btn-danger">Διαγραφή
                                    </button>
                                    {!! Form::open(['method' => 'GET', 'action' => ['MissionController@delete', 'id' => $mission->id], 'id' =>
                                    'deleteMission']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @else
                            <div class="col-sm-12 col-md-12">
                                <p>Η αποστολή δεν βρέθηκε</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('footerScripts')
<script src="{{ asset('/js/pages/missions/delete.js')}}"></script>
@append
