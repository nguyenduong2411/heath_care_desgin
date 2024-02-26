<?php
include('../service/UserService.php');

use action\service\UserService;

var_dump($_POST);
var_dump($_REQUEST);

// $error = [];
// $userService = new UserService();

// $sysParams = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/milktea/setting/system_parameter.ini', true);

// $userName = trim($_POST['username']);
// $password = trim($_POST['password']);

// $sqlFilePath = $_SERVER['DOCUMENT_ROOT'] . '/milktea/sql/GetAccountByUserName.sql';
// $sqlParams = [
//     'userName' => $userName
// ];

// $account = $userService->getAccountByUserName($sqlFilePath, $sqlParams);

// if (count($account) == 0) {
//     header('Location: /milktea/product-not-found.html');
// }

// $rawPassword = $sysParams['PASSWORD_PEPPER'] . $password . $account['salt'];

// if (password_verify($rawPassword, $account['password'])) {
//     session_start();
//     $_SESSION['user_session'] = $account['user_id'];
//     header('Location: /milktea/profile.html');
//     exit();
// } else {
//     echo "Địa chỉ email hoặc mật khẩu không hợp lệ!";
// }