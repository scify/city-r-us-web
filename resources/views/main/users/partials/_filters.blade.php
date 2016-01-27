<div id='user-filter'>
    <h1>Επιλογή αποστολής</h1>
    <div id="missions">
        <a href="/users" class="mission {{$active == 'total' ? 'active' : ''}}" title="Σύνολο">Σύνολο</a>
        @foreach ($missions as $mission)
        <a href="/users/{{$mission->id}}" class="mission {{$active == $mission->id ? 'active' : ''}}" title="{{$mission->description}}">{{$mission->name}}</a>
        @endforeach
    </div>
</div>