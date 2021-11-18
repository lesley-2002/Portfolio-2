$("#form").on( "submit", function () {

    var info = $('#info');
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var subject = $("#subject").val();
    var message = $("#message").val();


    $("#info").empty(); // To empty previous error/success message.
    $('#info').hide();
    // Checking for blank fields.
    // Returns successful data submission message when the entered information is stored in database.
        $('#form').trigger("reset");
        $('#info').append('<p>Your query is succesfully send!</p>').css('background-color', 'green').fadeIn().delay( 5000 ).fadeOut();
        $.post("contactform.php", {
            name1: name,
            email1: email,
            phone1: phone,
            subject1: subject,
            message1: message,
        }, function (data) {
            $("#info").append(data); // Append returned message to message paragraph.
            if (data == "Your Query has been received, We will contact you soon.") {
                
            }
        });
    return false;
});