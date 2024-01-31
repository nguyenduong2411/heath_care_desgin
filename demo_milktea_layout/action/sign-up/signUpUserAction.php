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

header('Location: /milktea/profile.html');
