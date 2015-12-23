scify = window.scify || {};

scify.ActivityOnMap = function (mapId, markericon,lat, long,zoom, loadObservationsTemplateUrl, loadEventsUrl,loadVenuestsUrl) {
    this.mapId = mapId;
    this.markers = [];
    this.markersEvents = [];
    this.markersVenues = [];
    this.paths =[];
    this.markericon = markericon;
    this.map = null;
    this.oms = null; //https://github.com/jawj/OverlappingMarkerSpiderfier
    this.lat= lat;
    this.long = long;
    this.zoom =zoom;
    this.loadObservationsTemplateUrl= loadObservationsTemplateUrl; //this should contain a parameter ({id}) that will be replaces with the mission id
    this.loadEventsUrl= loadEventsUrl;
    this.loadVenuestsUrl = loadVenuestsUrl;
};
scify.ActivityOnMap.prototype = function () {
    var baseUrl = $("#map-section").attr("data-url");

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

        /**
         * Clears all markers seaved in an array
         * @param markers
         */
        clearMarkersEvents = function(){
            this.oms.clearMarkers(); // Removes every marker from being tracked.
            //remove listeners on markers
            // this.oms.clearListeners(mapTeamOnMap);

            for (var i = 0; i < this.markersEvents.length; i++) {
                this.markersEvents[i].setMap(null);
            }
            this.markersEvents = [];;
        },

        /**
         * Clears all markers seaved in an array
         * @param markers
         */
        clearMarkersVenues = function(){
            this.oms.clearMarkers(); // Removes every marker from being tracked.
            //remove listeners on markers
            // this.oms.clearListeners(mapTeamOnMap);

            for (var i = 0; i < this.markersVenues.length; i++) {
                this.markersVenues[i].setMap(null);
            }
            this.markersVenues = [];;
        },

        displayLocationData = function(devices){
            var instance = this;
            var marker = null;
            $.each(devices, function (deviceIndex, device) {
                    $.each(device.observations, function (observationIndex, observation) {
                        $.each(observation.measurements, function (index, element) {
                            var icon = baseUrl + '/img/marker.png';
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(element.latitude, element.longitude),
                                title: element.displayName,
                                icon: icon,
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

            clearMarkersAndPaths.call(instance);
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

        /**
         * Display the near by events from getEvents API function
         */
        displayEvents = function(){
            var instance = this;
            var marker = null;
            maCenterLatLng = {lat: instance.map.getCenter().lat(), lng: instance.map.getCenter().lng()};
            //alert(instance.map.getCenter().lng());
            //clearMarkersEvents.call(instance);
            $.ajax({
                //url here with api results and center of map
                url: instance.loadEventsUrl + "?lat="+maCenterLatLng.lat+"&lon="+maCenterLatLng.lng,
                success: function (data) {
                    var i;
                    var iconGreen = baseUrl + '/img/marker_green.png';
                    for(i=0; i < data.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
                            map: instance.map,
                            icon: iconGreen,
                            title: data[i].title,
                            id: "events"
                        });
                        var infowindow = new google.maps.InfoWindow();
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent("<div style='text-align:center;'>" +
                                                data[i].venue_name + "<br>" + data[i].title + "<br>" + data[i].venue_address + "<br>"+
                                                "Starts: " + data[i].start_time + "<br>" + "Ends: " + data[i].stop_time + "<br>" +
                                                "<a target='_blank' href='"+data[i].venue_url+"'>Check Event</a>" + "</div>");
                                infowindow.open(instance.map, marker);
                            }
                        })(marker, i));
                        instance.oms.addMarker(marker);
                        instance.markersEvents.push(marker);
                    }
                },
                error: function(){
                    displayGenericErrorMsg();
                }
            });
            $("#hideEvents").removeClass("hide");
        },
        // Sets the map on all markers in the array.
        hideEventMarkers = function () {
            var instance = this;
            for (var i = 0; i < instance.markersEvents.length; i++) {
                instance.markersEvents[i].setMap(null);
            }
        },

        /**
         * Show points of interest on click from getVenues API function
         */
        displayPoI = function(){
            var instance = this;
            var marker = null;
            maCenterLatLng = {lat: instance.map.getCenter().lat(), lng: instance.map.getCenter().lng()};

            clearMarkersVenues.call(instance);
            $.ajax({
                //url here with api results and center of map
                url: instance.loadVenuestsUrl + "?lat="+maCenterLatLng.lat+"&lon="+maCenterLatLng.lng,
                success: function (data) {
                    //if (data.status =="success"){
                    var i;
                    var iconPurple = baseUrl + '/img/marker_purple.png';
                    for(i=0; i < data.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data[i].location.lat, data[i].location.lng),
                            map: instance.map,
                            icon: iconPurple,
                            title: data[i].name
                        });
                        var infowindow = new google.maps.InfoWindow();
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent("<div style='text-align:center;'>" +
                                            data[i].name + "<br>" + "Category: " + data[i].categories[0].name + "<br>" + "Here now: " + data[i].hereNow.summary + "<br>"+
                                            "Location: " + data[i].location.formattedAddress + "<br>" + "</div>");
                                infowindow.open(instance.map, marker);
                            }
                        })(marker, i));
                        instance.oms.addMarker(marker);
                        instance.markersVenues.push(marker);
                    }
                    //}
                    //else{
                    //    displayGenericErrorMsg();
                    //}
                },
                error: function(){
                    displayGenericErrorMsg();
                }
            })
            $("#hidePoIs").removeClass("hide");
        },

        /**
         * Initialization of the whole process
         */
        init = function () {
            var instance = this;
            var myLatlng = new google.maps.LatLng(instance.lat,instance.long);
            var mapOptions = {
                zoom: instance.zoom,
                scrollwheel: true,
                panControl: true,
                panControlOptions: {position: google.maps.ControlPosition.BOTTOM_RIGHT},
                zoomControl: true,
                zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_BOTTOM},
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
            $("#show-events").click(displayEvents.bind(instance));
            $("#hideEvents").click(hideEventMarkers.bind(instance));
            $("#show-pois").click(displayPoI.bind(instance));
        }

    return {
        init: init
    }
}();
