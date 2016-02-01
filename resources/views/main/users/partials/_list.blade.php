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
            <span class="glyphicon glyphicon-envelope" aria-hidden="true" title="Send e-mail"
                  onclick="showModal({{$user['id']}})"></span>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="email_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h4 class="modal-title">Αποστολή E-mail</h4>
            </div>
            <div class="modal-body">
                <form id="email_form" action="/users/mail" method="post">
                    <div class="form-group">
                        <label for="email_subject">Θέμα*:</label>
                        <input type="text" class="form-control" id="email_subject" name="subject"/>
                        <input type="hidden" id="email_user_id" name="user"/>
                    </div>
                    <div class="form-group">
                        <label for="email_body">Περιεχόμενο*:</label>
                        <textarea class="form-control" id="email_body" name="body" rows="5"></textarea>
                    </div>
                </form>
                <div class="text-danger"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Άκυρο</button>
                <input type="submit" form="email_form" class="btn btn-primary" id="sendEmail" value="Αποστολή"/>
            </div>
        </div>
    </div>
</div>


@section('footerScripts')

<script>

    $("#sendEmail").click(function () {

        if (validate()) {
            $.ajax({
                url: $("body").attr('data-url') + "/actions/task/create",
                method: 'GET',
                data: $("#createTask").serialize(),
                success: function (result) {
                    location.reload();
                }
            });
        }

    });


    function validate() {

        var msg = '';

        if (!$("#email_subject").val() || !$("#email_subject").val().length)
            msg += "<p>Συμπληρώστε το θέμα του email<p>";

        if (!$("#email_subject").val() || !$("#email_subject").val().length)
            msg += "<p>Συμπληρώστε το κείμενο του email<p>";


    }
</script>
@append
