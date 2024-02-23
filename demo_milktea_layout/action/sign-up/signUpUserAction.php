<?php
include('../service/UserService.php');
include('../service/MailService.php');
include('../service/FileService.php');
include('../../setting/constants.php');

use action\service\UserService;
use action\service\MailService;
use action\service\FileService;

$error = [];
$userService = new UserService();
$mailService = new MailService();
$fileService = new FileService();

// Get tham số từ được submit từ form
$userName = htmlspecialchars(trim($_POST['username']));
$email    = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

// mã hóa password
$salt = bin2hex(random_bytes(16));
$rawPassword = $userService->makePasswordHash($password, $salt);

$sqlFilePath = SQL_DIR . "/RegisterUserAccount.sql";
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

// Tạo mã xác thực
$verificationCode = rand(100000, 999999);

// Gửi mail xác minh
if ($userService->sendVerifyMail(array($email), $verificationCode)) {
  echo "Email successfully sent to $email...";
}

header('Location: /milktea/profile.html');
