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
    var MISSIONS = {
        handlerData: function (response) {

            //before displaying the results with the help of handlebars,
            //prepare the data to be ready
            $.each(response.message.missions, function (index, mission) {
                //correctly set the img path
                if(mission.img_name==null || mission.img_name=='')
                    mission.img_name = $('meta[name=url]').attr('content') + '/img/mission.png';
                else
                    mission.img_name = $('meta[name=url]').attr('content') + '/uploads/missions/' + mission.img_name;

                //set the profile url
                mission.url = $('meta[name=url]').attr('content') + '/missions/' + mission.id;
            });


            var templateSource = $("#template").html(),
                template = Handlebars.compile(templateSource),
                html = template(response.message);
            $('#container').html(html);
        },
        load: function () {
            $.ajax({
                url: $('meta[name=apiUrl]').attr('content') + '/missions',
                method: 'get',
                success: this.handlerData

            });
        }
    };
    MISSIONS.load();
</script>
@append
