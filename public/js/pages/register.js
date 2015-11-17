$("#errors").hide();

$("#registrationForm").submit(function () {

    if (validate()) {

        var url = $('meta[name=apiUrl]').attr('content') + '/users/register';

        console.log($("#registrationForm").serialize())

        $.ajax({
            type: "POST",
            url: url,
            data: $("#registrationForm").serialize(), // serializes the form's elements.
            success: function (data) {
                $("#errors").hide();
                window.location.href = $('meta[name=url]').attr('content') + "/auth/login";
            },
            error: function (data) {

                if (data.responseJSON != null) {
                    var msg = '<ul>';

                    if (data.responseJSON.error == 'email_exists')
                        msg += '<li>Το email υπάρχει ήδη.</li>';

                    msg += '</ul>';

                    $("#errors").html(msg);
                    $("#errors").show();
                }
                else
                    alert("An error occurred" + data);
            }
        });

    }
    return false; // avoid to execute the actual submit of the form.
});


//validate the form before submitting
function validate() {

    var msg = '<ul>';
    var isValid = true;
    var name = $("input[name=name]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();
    var password_confirmation = $("input[name=password_confirmation]").val();


    if (!name || !name.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Όνομα".</li>';
        isValid = false;
    }
    if (!email || !email.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Email".</li>';
        isValid = false;
    }
    if (!password || !password.trim()) {
        msg += '<li>Παρακαλώ συμπληρώστε το πεδίο "Κωδικός".</li>';
        isValid = false;
    }
    if (password.length < 6) {
        msg += '<li>Ο κωδικός πρέπει να έχει μήκος τουλάχιστον 6 χαρακτήρες.</li>';
        isValid = false;
    }
    if (password != password_confirmation) {
        msg += '<li>Οι κωδικοί δεν είναι ίδιοι.</li>';
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
