$("#errors").hide();
$("#createMission").submit(function (e) {
    console.log('submit')

    e.preventDefault();
    e.returnValue = false;

    if (validate()) {

        var url = $('meta[name=apiUrl]').attr('content') + '/missions/store';

        $.ajax({
            type: "POST",
            url: url,
            data: $("#createMission").serialize(), // serializes the form's elements.
            headers: {
                "Authorization": "Bearer " + $.cookie("jwtToken")
            },
            success: function (response) {
                console.log(response);

                if(response.status=='success') {
                    $("#errors").hide();
                    //redirect to login
                    //window.location.href = $('meta[name=url]').attr('content') + "/missions"
                }
                else{
                    if (response.errors != null) {
                        var msg = '<ul>';

                        $.each(response.errors, function( i, error ) {

                            if (error == '')
                                msg += '<li>Τα στοιχεία δεν αντιστοιχούν σε κανένα χρήστη.</li>';
                            if (error == 'could_not_create_token')
                                msg += '<li>Σφάλμα</li>';
                        });

                        msg += '</ul>';

                        $("#errors").html(msg);
                        $("#errors").show();
                    }
                    return false;
                }
            },
            error: function (response) {
                console.log(response);
            }
           /* complete: function() {
                // make sure that you are no longer handling the submit event; clear handler
                $("#createMission").off('submit');
                // actually submit the form
                $("#createMission").submit();
            }*/
        });
    }
});


//validate the form before submitting
function validate() {

    var msg = '<ul>';
    var isValid = true;
    var name = $("input[name=name]").val();


    if (!name || !name.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Όνομα".</li>';
        isValid = false;
    }
    if (!$("input[name='type']:checked").val()) {
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
