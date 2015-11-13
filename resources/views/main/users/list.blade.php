@extends('template.default')
@section('title')
users
@stop
@section('pageTitle')
users
@stop

@section('bodyContent')


@stop


@section('footerScripts')
<script src="{{ asset('/js/pages/jwt.js')}}"></script>

<script>

    checkJWT();

    var url = $('meta[name=apiUrl]').attr('content') + '/users';

    var token = $.cookie("jwtToken");

    $.ajax({
        url: url,
        type: "GET",
       headers: {
            'authorization': 'bearer ' + token
        },
        success: function () {
            // console.log('Cookie received!');
        },
        error: function () {
            // console.log('Problem with cookie');
        }
    });
</script>


@append
