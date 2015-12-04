$("#errors").hide();
$("#editMission").submit(function (e) {
    console.log('submit')

    e.preventDefault();
    e.returnValue = false;

    if (validate()) {
        $("#editMission").off('submit');
        $("#editMission").submit();
    }
});


//validate the form before submitting
function validate() {

    var msg = '<ul>';
    var isValid = true;
    var name = $("input[name=name]").val();
    var description = $("textarea[name=description]").val();


    if (!name || !name.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Όνομα".</li>';
        isValid = false;
    }
   if (!description || !description.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Περιγραφή".</li>';
        isValid = false;
    }
    if (!$("input[name='mission_type']:checked").val()) {
        msg += '<li>Παρακαλώ επιλέξτε τύπο αποστολής.</li>';
        isValid = false;
    }

    msg += '</ul>';

    if (!isValid) {
        $("#errors").html(msg);
        $("#errors").show();
    }
    else
        $("#errors").hide();

    return isValid;
}
