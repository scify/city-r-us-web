scify = window.scify || {};

scify.ActivityOnMap = function (mapId, markericon, lat, long, zoom, loadObservationsTemplateUrl, loadEventsUrl, loadVenuestsUrl) {
    this.mapId = mapId;
    this.markers = [];
    this.markersEvents = [];
    this.markersPoIs = [];
    this.paths = [];
    this.observations = [];
    this.markericon = markericon;
    this.map = null;
    this.oms = null; //https://github.com/jawj/OverlappingMarkerSpiderfier
    this.lat = lat;
    this.long = long;
    this.zoom = zoom;
    this.loadObservationsTemplateUrl = loadObservationsTemplateUrl; //this should contain a parameter ({id}) that will be replaces with the mission id
    this.loadEventsUrl = loadEventsUrl;
    this.loadVenuestsUrl = loadVenuestsUrl;
    this.showEvents = false;
    this.showPois = false;
    this.updatePoint = 0;
};
scify.ActivityOnMap.prototype = function () {
    var baseUrl = $("#map-section").attr("data-url");

    var getMapStyles = function () {
        return [
            {
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
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]
            }
        ];
    },
            selectMission = function (e) {
                if (e.type === "click") {
                    var mission = $(e.target);
                    $(".mission").removeClass("active");
                    mission.addClass("active");
                }
                resetMap.bind(this)();
            },
            resetMap = function () {
                var instance = this;
                instance.updatePoint++;
                var curUpdatePoint = instance.updatePoint;
                var url = instance.loadObservationsTemplateUrl.replace("{id}", $(".mission.active").data("id"));
                $.ajax({
                    url: url,
                    data: {
                        from: $('.datepicker.from input').val(),
                        to: $('.datepicker.to input').val()},
                    success: function (data) {
                        if (instance.updatePoint !== curUpdatePoint) {
                            return;
                        }
                        if (data !== null && data.status === "success") {
                            instance.observations = [];
                            clearPaths(instance.paths);
                            instance.paths = [];
                            clearMarkers.bind(instance)(instance.markers);
                            instance.markers = [];
                            if (data.message.type_id === "1") {
                                displayLocationData.call(instance, data.message.devices);
                            }
                            else {
                                displayRouteData.call(instance, data.message.devices);
                            }
                            if (instance.showEvents) {
                                loadEvents.bind(instance)();
                            }
                            if (instance.showPois) {
                                loadPois.bind(instance)();
                            }
                        }
                        else {
                            displayGenericErrorMsg();
                        }
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
            },
            clearMarkers = function (markers) {
                for (var i = 0; i < markers.length; i++) {
                    this.oms.removeMarker(markers[i]);
                    this.mc.removeMarker(markers[i]);
                    markers[i].setMap(null);
                }
            },
            clearPaths = function (paths) {
                for (var i = 0; i < paths.length; i++) {
                    paths[i].setMap(null);
                }
            },
            displayLocationData = function (devices) {
                var instance = this;
                var marker = null;

                $.each(devices, function (deviceIndex, device) {
                    $.each(device.observations, function (observationIndex, observation) {
                        if (typeof observation === 'undefined') {
                            return;
                        }
                        instance.observations.push(observation.id);
                        $.each(observation.measurements, function (index, element) {
                            console.log("added");
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
                });
                instance.mc.addMarkers(instance.markers);
            },
            displayRouteData = function (devices) {
                var instance = this;
                var path = null;
                var color = '#1133cc';

                $.each(devices, function (deviceIndex, device) {
                    $.each(device.observations, function (observationIndex, observation) {
                        if (typeof observation === 'undefined') {
                            return;
                        }
                        instance.observations.push(observation.id);
                        if (observation.measurements.length > 1) {
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
                                strokeColor: color,
                                strokeOpacity: 1.0,
                                strokeWeight: 4
                            });
                            path.setMap(instance.map);
                            instance.paths.push(path);
                            color = mutateColor(color);
                            console.log(color);
                        }
                    });
                });
            },
            componentToHex = function (c) {
                var hex = c.toString(16);
                return hex.length === 1 ? "0" + hex : hex;
            },
            rgbToHex = function (r, g, b) {
                return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
            },
            hexToRgb = function (hex) {
                var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            },
            mutateColor = function (color) {
                var rgb = hexToRgb(color);
                if (rgb.r > rgb.g) {
                    if (rgb.r > rgb.b) {
                        rgb.r -= ~~Math.random() * 40 + 40;
                        rgb.g += ~~Math.random() * 40 + 40;
                    } else {
                        rgb.b -= ~~Math.random() * 40 + 40;
                        rgb.r += ~~Math.random() * 40 + 40;
                    }
                } else if (rgb.g > rgb.b) {
                    rgb.g -= ~~Math.random() * 40 + 40;
                    rgb.b += ~~Math.random() * 40 + 40;
                } else {
                    rgb.b -= ~~Math.random() * 40 + 40;
                    rgb.r += ~~Math.random() * 40 + 40;
                }
                return rgbToHex(rgb.r, rgb.g, rgb.b);
            },
            displayGenericErrorMsg = function () {
                alert("Συνέβει ενα σφάλμα κατα την φόρτωση των δεδομένων");
            },
            loadEvents = function () {
                var instance = this;
                var marker = null;
                var curUpdatePoint = instance.updatePoint;
                var maCenterLatLng = {lat: instance.map.getCenter().lat(), lng: instance.map.getCenter().lng()};
                $.ajax({
                    url: instance.loadEventsUrl + "?lat=" + maCenterLatLng.lat + "&lon=" + maCenterLatLng.lng,
                    success: function (data) {
                        if (instance.updatePoint !== curUpdatePoint) {
                            return;
                        }
                        clearMarkers.bind(instance)(instance.markersEvents);
                        instance.markersEvents = [];
                        var iconGreen = baseUrl + '/img/marker_green.png';
                        for (var i = 0; i < data.length; i++) {
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
                        }
                        instance.mc.addMarkers(instance.markersEvents);
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
            },
            loadPois = function () {
                var instance = this;
                var marker = null;
                var curUpdatePoint = instance.updatePoint;
                maCenterLatLng = {lat: instance.map.getCenter().lat(), lng: instance.map.getCenter().lng()};
                $.ajax({
                    url: instance.loadVenuestsUrl + "?lat=" + maCenterLatLng.lat + "&lon=" + maCenterLatLng.lng,
                    success: function (data) {
                        if (instance.updatePoint !== curUpdatePoint) {
                            return;
                        }
                        clearMarkers.bind(instance)(instance.markersPoIs);
                        instance.markersPoIs = [];
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
                        }
                        instance.mc.addMarkers(instance.markersPoIs);
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
            },
            displayEvents = function () {
                this.showEvents = !this.showEvents;
                if (this.showEvents) {
                    $('#show-events').addClass('active');
                } else {
                    $('#show-events').removeClass('active');
                    clearMarkers.bind(this)(this.markersEvents);
                }
                resetMap.bind(this)();
            },
            displayPoI = function () {
                this.showPois = !this.showPois;
                if (this.showPois) {
                    $('#show-pois').addClass('active');
                } else {
                    $('#show-pois').removeClass('active');
                    clearMarkers.bind(this)(this.markersPoIs);
                }
                resetMap.bind(this)();
            },
            formatDate = function (date) {
                var d = new Date(date);
                var date = [(d.getDate()),
                    d.getMonth() + 1,
                    d.getFullYear()].join('/');

                return date;
            },
            addMarkers = function () {
                var instance = this;
                var curUpdatePoint = instance.updatePoint;
                var url = instance.loadObservationsTemplateUrl.replace("{id}", $(".mission.active").data("id"));
                $.ajax({
                    url: url,
                    data: {
                        from: $('.datepicker.from input').val(),
                        to: $('.datepicker.to input').val()},
                    success: function (data) {
                        if (instance.updatePoint !== curUpdatePoint) {
                            return;
                        }
                        if (data !== null && data.status === "success") {
                            $.each(data.message.devices, function (deviceIndex, device) {
                                $.each(device.observations, function (observationIndex, observation) {
                                    for (var i = 0; i < instance.observations.length; i++) {
                                        if (instance.observations[i] === observation.id) {
                                            delete device.observations[observationIndex];
                                            break;
                                        }
                                    }
                                });
                            });
                            if (data.message.type_id === "1") {
                                displayLocationData.call(instance, data.message.devices);
                            }
                            else {
                                displayRouteData.call(instance, data.message.devices);
                            }
                        }
                        else {
                            displayGenericErrorMsg();
                        }
                    },
                    error: function () {
                        displayGenericErrorMsg();
                    }
                });
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
        instance.map.addListener('dragend', function () {
            resetMap.bind(instance)();
        });

        var mcOptions = {gridSize: 50, maxZoom: 15};
        instance.mc = new MarkerClusterer(instance.map, [], mcOptions);

        instance.oms = new OverlappingMarkerSpiderfier(instance.map, {
            markersWontMove: true,
            markersWontHide: true,
            keepSpiderfied: true,
            nearbyDistance: 25
        });

        setTimeout((function () {
            addMarkers.bind(instance)();
            setTimeout(arguments.callee.bind(instance), 15000);
        }).bind(instance), 15000);

        $("#filters").on("click", ".mission", selectMission.bind(instance));
        $("#show-events").click(displayEvents.bind(instance));
        $("#show-pois").click(displayPoI.bind(instance));
        $("#filters").find(".mission").first().trigger("click");
        $(".datepicker input").change(selectMission.bind(instance));
    };

    return {
        init: init
    };
}();
