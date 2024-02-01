$("document").ready(function () {
  $("#login-btn").on("click", function () {
    $("#login-form").trigger("submit");
  });
  /* handling form validation */
  $("#login-form").validate({
    rules: {
      password: {
        required: true,
      },
      username: {
        required: true,
      },
    },
    messages: {
      password: {
        required: "Vui lòng nhập lại mật khẩu",
      },
      username: {
        required: "Vui lòng nhập tên đăng nhập",
      },
    },
    submitHandler: submitForm,
  });
  // /* Handling login functionality */
  function submitForm() {
    var data = $("#login-form").serialize();
    console.log(data);
    $.ajax({
      type: "POST",
      url: "../milktea/action/login/loginAction.php",
      data: data,
      beforeSend: function () {
        console.log("sending!");
        // $("#error").fadeOut();
        // $("#login-btn").html(
        //   '<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...'
        // );
      },
      success: function (response) {
        console.log("Oop!, error");
        if (response == "ok") {
          console.log("ok");
          // $("#login_button").html('<img src="ajax-loader.gif" /> &nbsp; Signing In ...');
          // setTimeout(' window.location.href = "welcome.php"; ',4000);
        } else {
          console.log(response);
          // $("#error").fadeIn(1000, function(){
          // 	$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
          // 	$("#login_button").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
          // });
        }
      },
    });
    return false;
  }
});
