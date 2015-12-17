$(function(){

    var mapActivity = new scify.ActivityOnMap( $("#map-container"),
        $("#map-container").data("marker-team"),
        $("#map-container").data("marker-event"),
        parseFloat($("#map-container").data("lat")),
        parseFloat($("#map-container").data("long")),
        parseFloat($("#map-container").data("zoom")),
        $("#map-container").data("no-events-message"),
        $("#map-container").data("marker-team-old")
    )

    mapActivity.init();

})