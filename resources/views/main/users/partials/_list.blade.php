<div id='user-list'>
    <h1 class="name">Όνομα</h1>
    <h1 class="score">Βαθμολογία</h1>
    <h1 class="send-mail">Email</h1>
    @foreach ($users as $user)
    <div class="user">
        <div class="name">
            {{$user['name']}}
        </div>
        <div class="score">
            {{$user['value']}}
        </div>
        <div class="send-mail">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true" title="Send e-mail"></span>
        </div>
    </div>
    @endforeach
</div>