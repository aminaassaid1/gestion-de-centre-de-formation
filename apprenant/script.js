$(document).ready(function () {
    $('#sujet').on('change', function () {
        var btn = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'home.php',
            data: {
                data: btn
                
            },
            dataType: 'json',
            success: function (response) {
                console.log(data);
                alert("hello");


            }
        });
    });
});