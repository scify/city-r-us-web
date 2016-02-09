@extends('template.default')
@section('title')
{{trans('admin_pages.viewMission')}}
@stop
@section('pageTitle')
{{trans('admin_pages.viewMission')}}
@stop

@section('bodyContent')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($mission!=null)
                        <div id="missionId" data-id="{{ $mission->id }}" style="display:none;"></div>
                        <div id="container"></div>
                        <div class="row">
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

                                    <p>{{trans('admin_pages.viewMission')}}: {{ $mission->type->name=='location' ?  trans('admin_pages.location') : trans('admin_pages.route') }}</p>

                                    <p>{{trans('admin_pages.creationDate')}}: {{ \Carbon::parse($mission->created_at)->format('d/m/Y')
                                        }}</p>
                                    @if($mission->description!=null)
                                    <p>{{trans('admin_pages.description')}}: {{ $mission->description }}</p>
                                    @endif
                                    <p>{{sizeof($mission->users)}} {{trans('admin_pages.contributors')}}</p>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('/missions/edit/'.$mission->id) }}" class="btn btn-success">
                                        {{trans('admin_pages.edit')}}</a>
                                    <button onclick="destroyMission({{ $mission->id }})" class="btn btn-danger">{{trans('admin_pages.delete')}}
                                    </button>
                                    {!! Form::open(['method' => 'GET', 'action' => ['MissionController@delete', 'id' => $mission->id], 'id' =>
                                    'deleteMission']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-sm-12 col-md-12">
                            <p>{{trans('admin_pages.missionNotFound')}}</p>
                        </div>
                        @endif
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
<script src="{{ asset('/js/pages/missions/delete.js')}}"></script>
@append
