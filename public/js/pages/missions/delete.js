function deleteMission(id) {
    console.log('deleting ' + id)

    if (confirm("Είστε σίγουροι ότι θέλετε να διαγράψετε την αποστολή;") == true) {

        $.when(deleteFile(id)).done(function (response) {
            //delete the mission itself
            $.ajax({
                url: $('meta[name=apiUrl]').attr('content') + '/missions/delete/' + id,
                method: 'POST',
                headers: {
                    "Authorization": "Bearer " + $.cookie("jwtToken")
                },
                success: function(response){
                    console.log(response);
                    window.location.href = $('meta[name=url]').attr('content') + "/missions"
                }
            });

        }).fail(function (jqXHR, textStatus) {
            console.log('fail?');
        });
    }
}


function deleteFile(id) {
    return $.ajax({
        url: $('meta[name=url]').attr('content') + '/missions/' + id + '/img/remove',
        method: 'GET'
    });
}





