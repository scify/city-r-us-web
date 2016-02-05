scify = window.scify || {};

scify.ActivityOnMap = function (mapId, markericon, lat, long, zoom, loadObservationsTemplateUrl, loadEventsUrl, loadVenuestsUrl) {
    this.mapId = mapId;
    this.markers = [];
    this.markersEvents = [];
    this.markersPoIs = [];
    this.paths = [];
    this.markericon = markericon;
    this.map = null;
    this.oms = null; //https://github.com/jawj/OverlappingMarkerSpiderfier
    this.lat = lat;
    this.long = long;
    this.zoom = zoom;
    this.loadObservationsTemplateUrl = loadObservationsTemplateUrl; //this should contain a parameter ({id}) that will be replaces with the mission id
    this.loadEventsUrl = loadEventsUrl;
    this.loadVenuestsUrl = loadVenuestsUrl;
};
scify.ActivityOnMap.prototype = function () {
    var baseUrl = $("#map-section").attr("data-url");

    var getMapStyles = function () {
        return [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{"color": "#444444"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{"color": "#f2f2f2"}]
            }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
                "featureType": "road",
                "elementType": "all",
                "stylers": [{"saturation": -100}, {"lightness": 45}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [{"visibility": "simplified"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [{"visibility": "off"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]}]
    },
            clearMarkersAndPaths = function () {
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
             * Clears all markers saved in an array
             * @param markers
             */
            clearMarkersEvents = function () {
                this.oms.clearMarkers(); // Removes every marker from being tracked.
                //remove listeners on markers
                // this.oms.clearListeners(mapTeamOnMap);

                for (var i = 0; i < this.markersEvents.length; i++) {
                    this.markersEvents[i].setMap(null);
                }
                this.markersEvents = [];
                ;
            },
            /**
             * Clears all markers saved in an array
             * @param markers
             */
            clearMarkersVenues = function () {
                this.oms.clearMarkers(); // Removes every marker from being tracked.
                //remove listeners on markers
                // this.oms.clearListeners(mapTeamOnMap);

                for (var i = 0; i < this.markersPoIs.length; i++) {
                    this.markersPoIs[i].setMap(null);
                }
                this.markersPoIs = [];
                ;
            },
            displayLocationData = function (devices) {
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
                instance.mc.clearMarkers();
                instance.mc.addMarkers(instance.markers);
            },
            displayRouteData = function (devices) {
                var instance = this;
                var path = null;
                $.each(devices, function (deviceIndex, device) {
                    $.each(device.observations, function (observationIndex, observation) {
                        if (observation.measurements.length > 1) //this should never happen. ROute data have always more than one location measurement attached
                        {
                            var coordinates = [];
                            $.each(observation.measurements, function (index, element) {
                                coordinates.push({lat: parseFloat(element.latitude), lng: parseFloat(element.longitude)});

                                if (index == 0 || index == observation.measurements.length - 1) {
                                    var icon = baseUrl + '/img/marker.png';
                                    marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(element.latitude, element.longitude),
                                        title: element.displayName,
                                        icon: icon,
                                        map: instance.map
                                    });
                                    instance.oms.addMarker(marker);
                                    instance.markers.push(marker);
                                }
                            });
                            path = new google.maps.Polyline({
                                path: coordinates,
                                geodesic: true,
                                strokeColor: '#3B6FA4',
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
                instance.mc.clearMarkers();
            },
            displayGenericErrorMsg = function () {
                alert("Συνέβει ενα σφάλμα κατα την φόρτωση των δεδομένων");
            },
            getMissionData = function (e) {
                this.showingMissions = true;
                this.showingEvents = false;

                var instance = this;
                var url = instance.loadObservationsTemplateUrl;
                if (typeof e !== "undefined" && e.type === "click") {
                    var mission = $(e.target);
                    var missionId = mission.data("id");
                    $("#show-pois").removeClass("active");
                    $(".mission").removeClass("active");
                    $("#show-events").removeClass("active");
                    mission.addClass("active");
                    url = url.replace("{id}", missionId);
                } else {
                    url = url.replace("{id}", $(".mission.active").data("id"));
                }

                clearMarkersAndPaths.call(instance);

                $.ajax({
                    url: url,
                    data: {
                        from: $('.datepicker.from input').val(),
                        to: $('.datepicker.to input').val()},
                    success: function (data) {
                        if (data != null && data.status == "success") {
                            if (data.message.type_id == 1)
                                displayLocationData.call(instance, data.message.devices);
                            else
                                displayRouteData.call(instance, data.message.devices);
                        }
                        else
                            displayGenericErrorMsg();
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
            },
            /**
             * Display the near by events from getEvents API function
             */
            displayEvents = function () {
                var avoidLoading = false;
                if (this.showingEvents) {
                    avoidLoading = true;
                }
                this.showingMissions = false;
                this.showingEvents = true;

                var instance = this;
                var marker = null;
                maCenterLatLng = {lat: instance.map.getCenter().lat(), lng: instance.map.getCenter().lng()};

                if (!avoidLoading) {
                    $(".loading").show();
                }
                $.ajax({
                    //url here with api results and center of map
                    url: instance.loadEventsUrl + "?lat=" + maCenterLatLng.lat + "&lon=" + maCenterLatLng.lng,
                    success: function (data) {
                        clearMarkersAndPaths.call(instance);
                        $(".loading").hide();
                        var i;
                        var iconGreen = baseUrl + '/img/marker_green.png';
                        for (i = 0; i < data.length; i++) {
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
                                map: instance.map,
                                icon: iconGreen,
                                title: data[i].title,
                                id: "events"
                            });
                            var infowindow = new google.maps.InfoWindow();
                            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                return function () {
                                    var start_time = formatDate(data[i].start_time);

                                    var content = "<div style='text-align:center;'><strong>" +
                                            data[i].title + "</strong><br/>" + data[i].venue_name + "<br/>" + data[i].venue_address + "<br/>" +
                                            "Starts: " + start_time + "<br/>";

                                    if (data[i].stop_time != null) {
                                        var stop_time = formatDate(data[i].stop_time);
                                        content += "Ends: " + stop_time + "<br/>";
                                    }

                                    content += "<a target='_blank' href='" + data[i].venue_url + "'>Check Event</a>" + "</div>";

                                    infowindow.setContent(content);
                                    infowindow.open(instance.map, marker);
                                };
                            })(marker, i));

                            instance.oms.addMarker(marker);
                            instance.markersEvents.push(marker);

                            instance.mc.clearMarkers();
                            instance.mc.addMarkers(instance.markersEvents);
                        }
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
//                $("#hideEvents").removeClass("hide");
                $("#show-events").addClass("active");
                $(".mission").removeClass("active");
                $("#show-pois").removeClass("active");
            },
            // Sets the map on all markers in the array.
            hideEventMarkers = function () {
                var instance = this;
                for (var i = 0; i < instance.markersEvents.length; i++) {
                    instance.markersEvents[i].setMap(null);
                }
                $("#hideEvents").addClass("hide");
                $("#show-events").removeClass("greenBack");
            },
            /**
             * Show points of interest on click from getVenues API function
             */
            displayPoI = function () {
                var avoidLoading = false;
                if (!this.showingEvents && !this.showingMissions) {
                    avoidLoading = true;
                }
                this.showingMissions = false;
                this.showingEvents = false;

                var instance = this;
                var marker = null;
                maCenterLatLng = {lat: instance.map.getCenter().lat(), lng: instance.map.getCenter().lng()};

                if (!avoidLoading) {
                    $(".loading").show();
                }
                $.ajax({
                    //url here with api results and center of map
                    url: instance.loadVenuestsUrl + "?lat=" + maCenterLatLng.lat + "&lon=" + maCenterLatLng.lng,
                    success: function (data) {
                        clearMarkersVenues.call(instance);
                        clearMarkersAndPaths.call(instance);
                        $(".loading").hide();
                        //if (data.status =="success"){
                        var i;
                        var iconPurple = baseUrl + '/img/marker_purple.png';
                        for (i = 0; i < data.length; i++) {
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(data[i].location.lat, data[i].location.lng),
                                map: instance.map,
                                icon: iconPurple,
                                title: data[i].name
                            });
                            var infowindow = new google.maps.InfoWindow();
                            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                return function () {
                                    infowindow.setContent("<div style='text-align:center;'><strong>" +
                                            data[i].name + "</strong><br/>" + "<em>" + data[i].categories[0].name + "</em><br/>" + data[i].location.formattedAddress + "<br/>"
                                            + "Here now: " + data[i].hereNow.summary + "<br></div>");
                                    infowindow.open(instance.map, marker);
                                };
                            })(marker, i));
                            instance.oms.addMarker(marker);
                            instance.markersPoIs.push(marker);

                            instance.mc.clearMarkers();
                            instance.mc.addMarkers(instance.markersPoIs);
                        }
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
//                $("#hidePoIs").removeClass("hide");
                $("#show-pois").addClass("active");
                $(".mission").removeClass("active");
                $("#show-events").removeClass("active");
            },
            hidePoIsMarkers = function () {
                var instance = this;
                for (var i = 0; i < instance.markersPoIs.length; i++) {
                    instance.markersPoIs[i].setMap(null);
                }
                $("#hidePoIs").addClass("hide");
                $("#show-pois").removeClass("purpleBack");

            },
            formatDate = function (date) {
                var d = new Date(date);
                var date = [(d.getDate()),
                    d.getMonth() + 1,
                    d.getFullYear()].join('/');

                return date;
            };

    /**
     * Initialization of the whole process
     */
    init = function () {
        var instance = this;
        var myLatlng = new google.maps.LatLng(instance.lat, instance.long);
        var mapOptions = {
            zoom: instance.zoom,
            scrollwheel: true,
            panControl: true,
            panControlOptions: {position: google.maps.ControlPosition.BOTTOM_RIGHT},
            zoomControl: true,
            zoomControlOptions: {position: google.maps.ControlPosition.RIGHT_BOTTOM},
            center: myLatlng,
            styles: getMapStyles()
        };
        instance.map = new google.maps.Map(instance.mapId[0], mapOptions);

        var mcOptions = {gridSize: 50, maxZoom: 15};
        instance.mc = new MarkerClusterer(instance.map, [], mcOptions);

        instance.oms = new OverlappingMarkerSpiderfier(instance.map, {
            markersWontMove: true,
            markersWontHide: true,
            keepSpiderfied: true,
            nearbyDistance: 25
        });

        instance.showingMissions = true;
        instance.showingEvents = false;

        $("#filters").on("click", ".mission", getMissionData.bind(instance));
        $("#filters").find(".mission").first().trigger("click");
        $("#show-events").click(displayEvents.bind(instance));
//        $("#hideEvents").click(hideEventMarkers.bind(instance));
        $("#show-pois").click(displayPoI.bind(instance));
//        $("#hidePoIs").click(hidePoIsMarkers.bind(instance));
        $(".datepicker input").change(getMissionData.bind(instance));

        setTimeout((function () {
            if (this.showingMissions) {
                getMissionData.bind(instance)();
            } else if (this.showingEvents) {
                displayEvents.bind(instance)();
            } else {
                displayPoI.bind(instance)();
            }
            setTimeout(arguments.callee.bind(instance), 15000);
        }).bind(instance), 15000);
    };

    return {
        init: init
    };
}();
