var MISSIONS = {
    handlerData: function (response) {

        var mission;

        if (response.status == 'success') {
            mission = response.message;

            //correctly set the img path
            if (mission.img_name == null || mission.img_name == '')
                mission.img_name = $('meta[name=url]').attr('content') + '/img/mission.png';
            else
                mission.img_name = $('meta[name=url]').attr('content') + '/uploads/missions/' + mission.img_name;

            //set the created date
            mission.creation = $.datepicker.formatDate("dd/mm/yy", new Date(mission.created_at));

            //set the edit url
            mission.editUrl = $('meta[name=url]').attr('content') + '/missions/edit/' + mission.id;
        }
        else
            mission = null;

        var templateSource = $("#template").html(),
            template = Handlebars.compile(templateSource),
            html = template(mission);
        $('#container').html(html);
    },
    load: function () {
        $.ajax({
            url: $('meta[name=apiUrl]').attr('content') + '/missions/byId?id=' + $("#missionId").attr('data-id'),
            method: 'get',
            success: this.handlerData
        });
    }
};
MISSIONS.load();
