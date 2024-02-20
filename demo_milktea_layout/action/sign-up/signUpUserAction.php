<?php
include('../service/UserService.php');

use action\service\UserService;

$error = [];
$userService = new UserService();

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

$result = $userService->registerAccount($sqlFilePath, $sqlParams);

if (!$result) {
    throw new \Exception('Không thể đăng account!');
}

$verificationCode = 123456;
$subject = "This is your verification code.";
$body = "
Hi! 
$userName! Please enter the verification code below on Hive.The code expires in 10 minutes, so be sure to enter within 10 minutes.
Verification Code: $verificationCode

Thank you!
BubbleTea-House
";
$headers = array(
    'From' => 'noreply@bubbletea-house.shop',
    'Reply-To' => 'noreply@bubbletea-house.shop',
    'X-Mailer' => 'PHP/' . phpversion()
);

if (mail($email, $subject, $body, $headers)) {
  echo "Email successfully sent to $email...";
} else {
  echo "Email sending failed...";
}

header('Location: /milktea/profile.html');
