$(function(){

    var mapActivity = new scify.ActivityOnMap( $("#map-container"),
        $("#map-container").data("marker-team"),
        parseFloat($("#map-container").data("lat")),
        parseFloat($("#map-container").data("long")),
        parseFloat($("#map-container").data("zoom"))
    )

    mapActivity.init();

})