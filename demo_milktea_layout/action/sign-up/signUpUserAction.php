<?php
include('../service/UserService.php');
include('../service/MailService.php');
include('../service/FileService.php');
require_once('../../setting/sqlFile.php');

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

// Kiểm tra user
$sqlParams = [
  'userName' => $userName
];
$result = $userService->getAccountByConditon(GET_ACCOUNT_BY_USER_NAME, $sqlParams);

if (count($result) > 0) {
  echo json_encode(([
    'status' => 'error',
    'detail' => [
      'msg_code' => 'E100',
      'msg' => 'User đã được đăng ký!'
    ]
  ]));
  exit();
}

// Kiểm tra email đã tồn tại
$sqlParams = [
  'userEmail' => $email
];
$result = $userService->getAccountByConditon(GET_ACCOUNT_BY_EMAIL, $sqlParams);
if ($result["cnt"] > 0) {
  header_remove();
  header("Content-Type: application/json; charset=utf-8");

  echo json_encode(([
    'status' => 'error',
    'detail' => [
      'msg_code' => 'E101',
      'msg' => 'Địa chỉ mail đã được đăng ký!'
    ]
  ]));
  exit();
}

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

// $result = $userService->registerAccount($sqlFilePath, $sqlParams);

// if (!$result) {
//     throw new \Exception('Không thể đăng account!');
// }

// Tạo mã xác thực
$verificationCode = rand(100000, 999999);

// Gửi mail xác minh
// if ($userService->sendVerifyMail(array($email), $verificationCode)) {
//   echo "Email successfully sent to $email...";
// }

echo json_encode(([
  'status' => 'ok',
  'detail' => [
    'msg_code' => 'I010',
    'msg' => 'Tài khoản đã được đăng ký thành công!'
  ]
]));
// header('Location: /milktea/profile.html');
