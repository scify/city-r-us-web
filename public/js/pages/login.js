$("#errors").hide();

$("#loginForm").submit(function () {

    if (validate()) {

        var url = $('meta[name=apiUrl]').attr('content') + '/users/login';

        console.log($("#loginForm").serialize())
        console.log(url);

        $.ajax({
            type: "POST",
            url: url,
            // dataType: 'jsonp',
            data: $("#loginForm").serialize(), // serializes the form's elements.
            success: function (data) {
                $("#errors").hide();

                //if the user was successfully created, then save the token to browser's local storage
                localStorage.setItem('jwt_token', data.token);

                //redirect to login
                window.location.href = $('meta[name=url]').attr('content') + "/dashboard";
            },
            error: function (data) {
                console.log(data);
                if (data.responseJSON != null) {
                    var msg = '<ul>';

                    if (data.responseJSON.error == 'invalid_credentials')
                        msg += '<li>Τα στοιχεία δεν αντιστοιχούν σε κανένα χρήστη.</li>';
                    if (data.responseJSON.error == 'could_not_create_token')
                        msg += '<li>Σφάλμα</li>';

                    msg += '</ul>';

                    $("#errors").html(msg);
                    $("#errors").show();
                }
            }
        });

    }
    return false; // avoid to execute the actual submit of the form.
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
