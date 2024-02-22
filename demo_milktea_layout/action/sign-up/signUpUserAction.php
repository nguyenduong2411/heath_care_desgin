<?php
include('../service/UserService.php');
include('../service/MailService.php');

use action\service\UserService;
use action\service\MailService;

$error = [];
$userService = new UserService();
$mailService = new MailService();

$userName = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = trim($_POST['password']);

$salt = bin2hex(random_bytes(16));
$rawPassword = $userService->makePasswordHash($password, $salt);

$sqlFilePath = $_SERVER['DOCUMENT_ROOT'] . "/milktea/sql/RegisterUserAccount.sql";
$sqlParams = [
    'userName' => $userName,
    'email' => $email,
    'password' => $rawPassword,
    'salt' => $salt,
];

// $result = $userService->registerAccount($sqlFilePath, $sqlParams);

// if (!$result) {
//     throw new \Exception('Không thể đăng account!');
// }

$verificationCode = rand(100000, 999999);
$from = "noreply@bubbletea-house.shop";
$to = array($email);
$subject = "Xác thực địa chỉ email của bạn";
$message = "
<html>
  <head>
    <title>Xác thực địa chỉ email</title>
  </head>
  <body>
    <table dir=\"ltr\">
      <tbody>
      <tr><td style=\"padding:0;font-family:'Segoe UI Light','Segoe UI','Helvetica Neue Medium',Arial,sans-serif;font-size:41px;color:#2672ec\">Mã xác thực địa chỉ email của bạn</td></tr>
      <tr><td style=\"padding:0;padding-top:25px;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a\">Bên dưới là mã xác minh của bạn. Mã xác thực sẽ hết hạn trong 10 phút, vì vậy hãy chắc chắn nhập trong vòng 10 phút.</td></tr>
      <tr><td style=\"padding:0;padding-top:25px;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a\">Mã xác thực: <span style=\"font-family:'Segoe UI Bold','Segoe UI Semibold','Segoe UI','Helvetica Neue Medium',Arial,sans-serif;font-size:14px;font-weight:bold;color:#2a2a2a\">$verificationCode</span></td></tr>
      <tr><td style=\"padding:0;padding-top:25px;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a\">Thanks,</td></tr>
      <tr><td style=\"padding:0;font-family:'Segoe UI',Tahoma,Verdana,Arial,sans-serif;font-size:14px;color:#2a2a2a\">BubbleTea-House</td></tr>
    </tbody></table>
	<div style=\"margin-top:10px\">Phòng 702, Tầng 7, Tòa nhà Central Plaza, số 17 Lê Duẩn, phường Bến Nghé, quận 1, Hồ Chí Minh</div></div>
  </body>
</html>
";

// $headers = array(
//     'From' => 'From: noreply@bubbletea-house.shop',
//     'To' => 'To: ' . $email,
//     'Reply-To' => 'noreply@bubbletea-house.shop',
//     'X-Mailer' => 'PHP/' . phpversion()
// );

// $headers = array(
//   'MIME-Version: 1.0',
//   'Content-type: text/html; charset=utf-8',
//   'From: noreply@bubbletea-house.shop',
//   'To: ' . $email,
//   'PHP/' . phpversion()
// );

// if (mail($email, $subject, $body, $headers)) {
if ($mailService->sendHtmlMail($from, $to, $subject, $message)) {
  echo "Email successfully sent to $email...";
}

// header('Location: /milktea/profile.html');
