// import {SIGNUP_MESSAGES} from "../common/message.js";
const { SIGNUP_MESSAGES } = require('../common/message.js');

const SIGNUP_MSG = {
  "INF_1000" : "Vui lòng nhập tên đăng nhập",
  "INF_1001" : "Số ký tự được phép nhập ít nhất: {0}, nhiều nhất {1}",
  "INF_1002" : "Vui lòng nhập địa chỉ email",
  "INF_1003" : "Vui lòng nhập đúng format của email",
  "INF_1004" : "Bạn đã nhập quá {0} ký tự!",
  "INF_1005" : "Vui lòng nhập mật khẩu",
  "INF_1006" : "Vui lòng nhập xác nhận mật khẩu",
  "INF_1007" : "Không khớp với mật khẩu",
};

$("document").ready(function () {
    $("#signup-button").on("click", function () {
      $("#signup-form").trigger("submit");
    });
    /* handling form validation */
    $("#signup-form").validate({
      rules: {
        username: {
          required: true,
          rangelength: [6, 50]
        },
        email: {
          required: true,
          email: true,
          maxlength: 255
        },
        password: {
          required: true,
          rangelength: [6, 100]
        },
        confirm: {
          required: true,
          equalTo: "#password"
        },
      },
      messages: {
        username: {
          required: SIGNUP_MSG.INF_1000,
          rangelength: jQuery.validator.format(SIGNUP_MSG.INF_1001)
        },
        email: {
          required: SIGNUP_MSG.INF_1002,
          email: SIGNUP_MSG.INF_1003,
          maxlength: jQuery.validator.format(SIGNUP_MSG.INF_1004)
        },
        password: {
          required: SIGNUP_MSG.INF_1005,
          rangelength: jQuery.validator.format(SIGNUP_MSG.INF_1001)
        },
        confirm: {
          required: SIGNUP_MSG.INF_1006,
          equalTo: SIGNUP_MSG.INF_1007,
        },
      },
      submitHandler: submitForm,
      errorClass: "form-validate-error-class",
      validClass: "form-validate-valid-class"
    });
    // /* Handling login functionality */
    function submitForm() {
      var data = $("#signup-form").serialize();
      console.log(data);
      $.ajax({
        type: "POST",
        url: "../milktea/action/sign-up/signUpUserAction.php",
        data: data,
        dataType: "html",
        beforeSend: function () {
          console.log("sending!");
        },
        success: function (response) {
          console.log(response);
          let data = JSON.parse(response);
          if (data.status == "ok") {
            console.log(data.detail.msg);
          } else {
            console.log("Oop!, error: ", data.detail.msg_code, ", msg:", data.detail.msg);
            if (data.detail.msg_code === "E100") {
              console.log(data.detail.msg);
            }
            
            if (data.detail.msg_code === "E101") {
              console.log(data.detail.msg);
            }
          }
        },
      });
      return false;
    }
  });
  