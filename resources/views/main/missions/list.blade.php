@extends('template.default')
@section('title')
Αποστολές
@stop
@section('pageTitle')
Αποστολές
@stop

@section('bodyContent')

<div class="row">
    <div class="col-md-12">
                @include('main.missions.partials._all')
    </div>
</div>

@stop

@section('footerScripts')
<script>
    var MISSIONS ={
        handlerData:function(response){
            console.log(response.message)
            var templateSource = $("#template").html(),
                template = Handlebars.compile(templateSource),
                html = template(response.message);
            $('#container').html(html);
        },
        load : function(){
            $.ajax({
                url: $('meta[name=apiUrl]').attr('content') + '/missions',
                method:'get',
                success:this.handlerData
            });
        }
    };
    MISSIONS.load();
</script>
@append
