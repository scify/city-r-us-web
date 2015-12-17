scify = window.scify || {};

scify.ActivityOnMap = function (mapId, markericon,lat, long,zoom) {
    this.mapId = mapId;
    this.markers = [];
    this.markericon = markericon;
    this.map = null;
    this.oms = null; //https://github.com/jawj/OverlappingMarkerSpiderfier
    this.lat= lat;
    this.long = long;
    this.zoom =zoom;

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
        clearMarkers = function(){
            this.oms.clearMarkers(); // Removes every marker from being tracked.
            //remove listeners on markers
           // this.oms.clearListeners(mapTeamOnMap);

            for (var i = 0; i < this.markers.length; i++) {
                this.markers[i].setMap(null);
            }
            this.markers = [];
        },
        displayMissionDataAsMarkers = function(response){
            var instance = this;
            var marker = null;
            $.each(response.result, function (index, element) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(element.lat, element.lng),
                    title: element.displayName,
                    icon: instance.markericon,
                    team: element,
                    map: instance.map
                });
                instance.oms.addMarker(marker);
                instance.markers.push(marker);
            });
            //add listeners on markers
            // instance.oms.addListener('click',mapTeamOnMap);
        },
        getMissionData = function(e){

            var instance = this;
            var mission = $(e.target);
            var missionId = mission.data("id");
            $(".mission.active").removeClass("active");
            mission.addClass("active");

            clearMarkers.call(instance );
            $.ajax({
                url: (window.location.pathname + 'services/api/rest/json/?method=group.all'),
                success: function (data) {
                    //if mission type is locations display on map
                    displayMissionDataAsMarkers.call(data,instance);
                }
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


            $("#filters").on("click",".mission",getMissionData.bind(instance));

        }

    return {
        init: init
    }
}();
