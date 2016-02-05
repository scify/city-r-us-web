function destroyMission(id) {
    if (confirm(Lang.get('admin_pages.deleteMission')) == true) {

        $("#deleteMission").off('submit');
        $("#deleteMission").submit();
    }
}


