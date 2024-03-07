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
    onfocusout: function (element) {
      $(element).valid();
    },
    errorClass: "form-validate-error-class",
    validClass: "form-validate-valid-class",
  });
  // /* Handling login functionality */
  function submitForm() {
    var data = $("#login-form").serialize();
    console.log(data);
    $.ajax({
      type: "POST",
      url: "../milktea/action/login/LoginAction.php",
      data: data,
      beforeSend: function () {
        console.log("sending!");
        $( "#password_verify_msg" ).text("");
      },
      success: function (response) {
        console.log("Oop!, error");
        if (response.status == "ok") {
          console.log("ok");
          $( "#password_verify_msg" ).text(response.body.msg);
          setTimeout(redirectToProfile, 2000);
        } else {
          console.log(response);
          $( "#password_verify_msg" ).text(response.body.msg);
        }
      },
    });
    return false;
  }

  function redirectToProfile() {
    window.location.href = "../milktea/profile.html";
  }
});
