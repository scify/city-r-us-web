function destroyMission(id) {
    if (confirm("Είστε σίγουροι ότι θέλετε να διαγράψετε την αποστολή;") == true) {

        $("#deleteMission").off('submit');
        $("#deleteMission").submit();
    }
}


