$(document).ready(function () {
    console.log("Login Success");

    $('.input-group-text .fa-lock').removeClass('fa-lock').addClass('fa-eye-slash');

});
$(".input-group-text").click(function () {
    console.log("Login 1");
    var passwordField = $(this).closest('.input-group').find('input');
    var fieldType = passwordField.attr("type");
    
    if (fieldType === "password") {
        passwordField.attr("type", "text");
        $(this).html('<i class="fas fa-eye"></i>');
        console.log("1");
    } else if (fieldType === "text") {
        passwordField.attr("type", "password");
        $(this).html('<i class="fas fa-eye-slash"></i>');
        console.log("2");
    }
});
