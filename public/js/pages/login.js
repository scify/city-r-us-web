$("#errors").hide();

$("#loginForm").submit(function (e) {

    e.preventDefault();
    e.returnValue = false;

    if (validate()) {

        var url = $('meta[name=apiUrl]').attr('content') + '/users/login';

        $.ajax({
            type: "POST",
            url: url,
            // dataType: 'jsonp',
            data: $("#loginForm").serialize(), // serializes the form's elements.
            success: function (response) {

                if(response.success) {
                    $("#errors").hide();

                    console.log('success');

                    console.log(response.data.token);
                    //if the user was successfully created, then save the token to browser's local storage
                    localStorage.setItem('jwt_token', response.data.token);

                    //redirect to login
                    //window.location.href = $('meta[name=url]').attr('content') + "/dashboard";


                }
                else{
                    console.log('error');
                    if (response.errors != null) {
                        var msg = '<ul>';

                        $.each(response.errors, function( i, error ) {

                            if (error == 'invalid_credentials')
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
            complete: function() {
                // make sure that you are no longer handling the submit event; clear handler
                $("#loginForm").off('submit');
                // actually submit the form
                $("#loginForm").submit();
            }
        });
    }
});


//validate the form before submitting
function validate() {

    var msg = '<ul>';
    var isValid = true;
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();


    if (!email || !email.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Email".</li>';
        isValid = false;
    }
    if (!password || !password.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Κωδικός".</li>';
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
