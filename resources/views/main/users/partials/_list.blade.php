<div id='user-list'>
    <h1 class="name">{{trans('admin_pages.name')}}</h1>

    <h1 class="score">{{trans('admin_pages.score')}}</h1>

    <h1 class="send-mail">{{trans('admin_pages.email')}}</h1>
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
                <h4 class="modal-title">{{trans('admin_pages.sendEmail')}}</h4>
            </div>
            <div class="modal-body sendEmail">
                {!! Form::open(['method' => 'POST', 'action' => 'UserController@emailUser', 'id' => 'emailUser']) !!}
                <div class="form-group">
                    <label for="email_subject">{{trans('admin_pages.subject')}}*:</label>
                    <input type="text" class="form-control" id="email_subject" name="subject"/>
                    <input type="hidden" id="email_user_id" name="user"/>
                </div>
                <div class="form-group">
                    <label for="email_body">{{trans('admin_pages.body')}}*:</label>
                    <textarea class="form-control" id="email_body" name="body" rows="5"></textarea>
                </div>
                <div class="text-danger" id="error"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin_pages.back')}}</button>
                <button type="button" class="btn btn-success has-spinner" id="sendEmail">
                    <span class="spinner"><i class="icon-spin icon-refresh"></i></span> {{trans('admin_pages.send')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


@section('footerScripts')

<script>


    $("#sendEmail").click(function () {

        if (validate()) {
            $(this).toggleClass('activated');
            $.ajax({
                url: $("body").attr('data-url') + "/users/emailUser",
                method: 'POST',
                data: $("#emailUser").serialize(),
                success: function (response) {
                    $(".modal-footer").hide();
                    $(".sendEmail").html('<p>{{trans('admin_pages.sent')}}</p>');
                }
            });
        }
    });


    function validate() {
        var msg = '';
        var flag = true;

        if (!$("#email_subject").val() || !$("#email_subject").val().length) {
            msg += "<p>{{trans('admin_pages.fill_subject')}}<p>";
            flag = false;
        }

        if (!$("#email_body").val() || !$("#email_body").val().length) {
            msg += "<p>{{trans('admin_pages.fill_body')}}<p>";
            flag = false;
        }

        $("#error").html(msg);

        return flag;
    }
</script>
@append
