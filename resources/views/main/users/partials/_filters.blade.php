<div id='user-filter'>
    <h1>{{trans('admin_pages.selectMission')}}</h1>
    <div id="missions">
        <a href="{{url('/users')}}" class="mission {{$active == 'total' ? 'active' : ''}}" title="Σύνολο">{{trans('admin_pages.total')}}</a>
        @foreach ($missions as $mission)
        <a href="{{url('/users/'.$mission->id)}}" class="mission {{$active == $mission->id ? 'active' : ''}}" title="{{$mission->description}}">{{$mission->name}}</a>
        @endforeach
    </div>
</div>
