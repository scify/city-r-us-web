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
        msg += '<li>' + Lang.get('admin_pages.addName') + '</li>';
        isValid = false;
    }
    if (!description || !description.trim()) {
        msg += '<li>' + Lang.get('admin_pages.addDescription') + '</li>';
        isValid = false;
    }
    if (!$("input[name='mission_type']:checked").val()) {
        msg += '<li>' + Lang.get('admin_pages.addType') + '</li>';
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
