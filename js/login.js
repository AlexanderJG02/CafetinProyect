$(document).ready(function() {
    $("#togglePassword").click(function() {
      var passwordField = $("#password");
      var passwordFieldType = passwordField.attr('type');
      if (passwordFieldType === "password") {
        passwordField.attr('type', 'text');
        $("#togglePassword").find('i').removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        $("#togglePassword").find('i').removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    $(".btn-pink").hover(function() {
      $(this).css("background-color", "#ff93d0");
      $(this).css("border-color", "#ff93d0");
    }, function() {
      $(this).css("background-color", "#ff69b4");
      $(this).css("border-color", "#ff69b4");
    });
  });