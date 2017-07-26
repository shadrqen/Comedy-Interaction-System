
    function uploadJoke (username) {

        var value = $("textarea#ta").val();

        $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../uploadjoke',
                data: {
               joke: value
            },
            success: function (data) {
                console.log(data);
                $("#userName").append(username);
                $('#joke').append(value);
                document.getElementById("ta").value = "";
                $('#div').removeClass('hidden');
            },
            error: function () {
                console.log('error');
            }
        });

    }



