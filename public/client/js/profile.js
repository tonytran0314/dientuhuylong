$(document).ready(function() {
  $('.password-field i').click(function() {

    // HIDE PASSWORD
    if ( $(this).next().attr("type") == "text" ) {

      // from type text to type password
      $(this).next().attr("type", "password");

      // remove class eye
      $(this).removeClass('fa-eye');

      // add class eye-slash
      $(this).addClass('fa-eye-slash');

    } 

    // SHOW PASSWORD
    else if ($(this).next().attr("type") == "password") {

      // from type password to type text
      $(this).next().attr("type", "text");

      // remove class eye-slash
      $(this).removeClass('fa-eye-slash');

      // add class eye
      $(this).addClass('fa-eye');

    }

  });
});