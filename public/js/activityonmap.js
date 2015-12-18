scify = window.scify || {};

scify.ActivityOnMap = function (mapId, markericon,lat, long,zoom, loadObservationsTemplateUrl) {
    this.mapId = mapId;
    this.markers = [];
    this.paths =[];
    this.markericon = markericon;
    this.map = null;
    this.oms = null; //https://github.com/jawj/OverlappingMarkerSpiderfier
    this.lat= lat;
    this.long = long;
    this.zoom =zoom;
    this.loadObservationsTemplateUrl= loadObservationsTemplateUrl; //this should contain a parameter ({id}) that will be replaces with the mission id

};
scify.ActivityOnMap.prototype = function () {

    var getMapStyles = function () {
            return [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]
        },
        clearMarkersAndPaths = function(){
            this.oms.clearMarkers(); // Removes every marker from being tracked.
            //remove listeners on markers
           // this.oms.clearListeners(mapTeamOnMap);

            for (var i = 0; i < this.markers.length; i++) {
                this.markers[i].setMap(null);
            }
            this.markers = [];

            for (var i = 0; i < this.paths.length; i++) {
                this.paths[i].setMap(null);
            }
            this.paths = [];

        },
        displayLocationData = function(devices){
            var instance = this;
            var marker = null;
            $.each(devices, function (deviceIndex, device) {
                    $.each(device.observations, function (observationIndex, observation) {
                        $.each(observation.measurements, function (index, element) {
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(element.latitude, element.longitude),
                                title: element.displayName,
                                //icon: instance.markericon,
                                map: instance.map
                            });
                            instance.oms.addMarker(marker);
                            instance.markers.push(marker);
                        });
                    });
                //add listeners on markers
                // instance.oms.addListener('click',mapTeamOnMap);
            });
        },
        displayRouteData = function(devices){
            var instance = this;
            var path = null;
            $.each(devices, function (deviceIndex, device) {
                $.each(device.observations, function (observationIndex, observation) {
                    if (observation.measurements.length>1) //this should never happen. ROute data have always more than one location measurement attached
                    {
                        var coordinates = [];
                        $.each(observation.measurements, function (index, element) {
                            coordinates.push({lat:parseFloat(element.latitude) , lng:parseFloat(element.longitude)});
                        });

                        path = new google.maps.Polyline({
                            path: coordinates,
                            geodesic: true,
                            strokeColor: '#FF0000',
                            strokeOpacity: 1.0,
                            strokeWeight: 2
                        });

                        path.setMap(instance.map);
                        instance.paths.push(path);
                    }

                });
                //add listeners on markers
                // instance.oms.addListener('click',mapTeamOnMap);
            });
        },
        displayGenericErrorMsg = function(){
            alert("Συνέβει ενα σφάλμα κατα την φόρτωση των δεδομένων");
        },
        getMissionData = function(e){

            var instance = this;
            var mission = $(e.target);
            var missionId = mission.data("id");
            $(".mission.active").removeClass("active");
            mission.addClass("active");

            clearMarkersAndPaths.call(instance );
            $.ajax({
                url: instance.loadObservationsTemplateUrl.replace("{id}",missionId),
                success: function (data) {
                    if (data.status =="success")
                    {
                        if (data.message.type_id==1)
                            displayLocationData.call(instance,data.message.devices);
                        else
                            displayRouteData.call(instance,data.message.devices);
                    }
                    else
                        displayGenericErrorMsg();
                },
                error: function(){
                    displayGenericErrorMsg();
                }
            });
        },
        init = function () {
            var instance = this;
            var myLatlng = new google.maps.LatLng(instance.lat,instance.long);
            var mapOptions = {
                zoom: instance.zoom,
                scrollwheel: true,
                panControl: true,
                panControlOptions: {position: google.maps.ControlPosition.TOP_RIGHT},
                zoomControl: true,
                zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_TOP},
                center: myLatlng,
                styles: getMapStyles()
            }
            instance.map = new google.maps.Map(instance.mapId[0], mapOptions);
            instance.oms = new OverlappingMarkerSpiderfier(instance.map, { markersWontMove:true,
                markersWontHide:true,
                keepSpiderfied:true,
                nearbyDistance:25
            });

            $("#filters").on("click",".mission",getMissionData.bind(instance));
            $("#filters").find(".mission").first().trigger("click");
        }

    return {
        init: init
    }
}();
