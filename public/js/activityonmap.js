scify = window.scify || {};

scify.ActivityOnMap = function (mapId, teamIconUrl,eventIconUrl, lat, long,zoom, noEventsMsg, oldteamIconUrl) {
    this.mapId = mapId;
    this.markers = [];
    this.teamIconUrl = teamIconUrl;
    this.eventIconUrl = eventIconUrl
    this.map = null;
    this.oms = null; //https://github.com/jawj/OverlappingMarkerSpiderfier
    this.lat= lat;
    this.long = long;
    this.zoom =zoom;
    this.noEventsMsg = noEventsMsg;
    this.oldteamIconUrl = oldteamIconUrl;
};
scify.ActivityOnMap.prototype = function () {

    var getMapStyles = function () {
            return [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative.locality",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "administrative.locality",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative.neighborhood",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural.landcover",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural.terrain",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#46bcec"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
        },
        mapTeamOnMap = function (marker) {
            if (!marker.team)
                return;
            var team = marker.team;
            if ($("#selected-team:visible").length > 0 &&
                $("#selected-team h2").text() == team.displayName) {
                return;
            }
            var promise1 =$("#intro").fadeOut();
            var promise2 =$("#selected-team").fadeOut();
            var promise3 =$("#selected-event").fadeOut();

            $.when(promise1,promise2,promise3).done(function(){
                var section = $("#selected-team")
                section.find("h2").text(team.displayName);
                section.find("img").attr("src", team.img);
                if ($.trim($(team.description).text()))
                    section.find(".descr").html(team.description);
                else
                    section.find(".descr").html(section.find(".descr").data("no-descr"));

                section.find(".header a").attr("href", team.page)
                section.fadeIn();
            });



        },
        mapEventOnMap = function(marker){
            if (!marker.event)
                return;

            var event = marker.event;
            if ($("#selected-event:visible").length > 0 &&
                $("#selected-event h2").text() == event.displayName) {
                return;
            }
            var promise1 =$("#intro").fadeOut();
            var promise2 =$("#selected-team").fadeOut();
            var promise3 =$("#selected-event").fadeOut();

            $.when(promise1,promise2,promise3).done(function(){
                var section = $("#selected-event")
                section.find("h2 a").text(event.displayName);
                // section.find("img").attr("src", event.img);
                section.find(".start-date").text(event.startDate);
                section.find(".end-date").text(event.endDate);
                section.find(".address").text(event.address)
                section.find(".creator").find("span").text(event.Group).attr("href",event.GroupURL );

                section.find(".info").show()
                if ($.trim($(event.descriptionFull).text()))
                    section.find(".descr").html(event.descriptionFull);
                else
                    section.find(".info").hide();

                section.find(".creator").attr("href", event.CreatorURL).text(event.Creator);
                section.find(".event-page").attr("href", event.url)
                section.fadeIn();
            });


        },
        clearMarkers = function(){
            this.oms.clearMarkers(); // Removes every marker from being tracked.
            this.oms.clearListeners(mapEventOnMap);
            this.oms.clearListeners(mapTeamOnMap);
            for (var i = 0; i < this.markers.length; i++) {
                this.markers[i].setMap(null);
            }
            this.markers = [];
        },
        getTeams = function(){

            if ($("#map-show-teams").hasClass("selected")) return;

            var instance = this;
            clearMarkers.call(instance );
            $(".map-filter").find("a").removeClass("selected");
            $("#map-show-teams").addClass("selected");

            $.ajax({
                url: (window.location.pathname + 'services/api/rest/json/?method=group.all'),
                success: function (response) {
                    var marker = null;
                    $("#teams-counter").find("span").html(response.result.length);
                    $.each(response.result, function (index, element) {
                        var iconOnMarker =instance.teamIconUrl;
                        if (element.quid < 3012)
                            iconOnMarker= instance.oldteamIconUrl;

                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(element.lat, element.lng),
                            title: element.displayName,
                            icon: iconOnMarker,
                            team: element,
                            map: instance.map
                        });

                        instance.oms.addMarker(marker);
                        instance.markers.push(marker);

                    });


                    instance.oms.addListener('click',mapTeamOnMap);

                }//,
                //error: function (x, z, g) {
                //    alert("An error occurred")
                //}
            });
        },
        getEvents= function(){

            var instance = this;
            if ($("#map-show-events").hasClass("selected")) return;

            $.ajax({
                url: (window.location.pathname + 'services/api/rest/json/?method=event.all'),
                success: function (response) {

                    if (response.result.length==0)
                        swal(instance.noEventsMsg);
                    else
                    {
                        $(".map-filter").find("a").removeClass("selected");
                        $("#map-show-events").addClass("selected");
                        clearMarkers.call(instance );
                    }
                    var marker = null;
                    $.each(response.result, function (index, element) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(element.lat, element.lng),
                            title: element.displayName,
                            icon: instance.eventIconUrl,
                            event: element,
                            map: instance.map
                        });

                        instance.oms.addMarker(marker);
                        instance.markers.push(marker);

                        //google.maps.event.addListener(marker, 'click', (function () { //this is an IFI (Self executing function)
                        //    //lets create a closure to protect the market.team variable
                        //    var event = marker.event;
                        //    return function () { //return the function that will triggered on market click
                        //        mapEventOnMap(event );
                        //    }
                        //
                        //})());

                    });

                    instance.oms.addListener('click',mapEventOnMap);
                },
                error: function (x, z, g) {
                    alert("An error occurred")
                }
            });
        },
        returnToIntroScreen = function () {

            $("#selected-team, #selected-event").fadeOut().promise().done(function () {
                $("#intro").fadeIn();
            });
        },
        init = function () {
            var instance = this;

            var myLatlng = new google.maps.LatLng(instance.lat,instance.long);
            var mapOptions = {
                zoom: instance.zoom,
                scrollwheel: false,
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
            $("#map-show-teams").click($.proxy(getTeams,instance));
            $("#map-show-events").click($.proxy(getEvents,instance));
            $(".info-back").click(returnToIntroScreen);

            getTeams.call(instance);


        }

    return {
        init: init
    }
}();
