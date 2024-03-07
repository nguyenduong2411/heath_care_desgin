<?php
require_once('../../setting/sqlFile.php');

include('../service/UserService.php');
include('../service/ResponseService.php');

use action\service\ResponseService;
use action\service\UserService;

$userService = new UserService();
$responseService = new ResponseService();

// Get tham số từ được submit từ form
$userName = htmlspecialchars(trim($_POST['username']));
$password = htmlspecialchars(trim($_POST['password']));

// Kiểm tra empty
if (empty($userName)) {
    $responseService->createResponse(
        "error",
        [
            'msg_code' => 'E301',
            'msg' => 'Vui lòng nhập tài khoản!'
        ]
    );
}

if (empty($password)) {
    $responseService->createResponse(
        "error",
        [
            'msg_code' => 'E302',
            'msg' => 'Vui lòng nhập mật khẩu!'
        ]
    );
}

$sqlParams = [
    'userName' => $userName
];
$account = $userService->getAccountByConditon(GET_ACCOUNT_BY_USER_NAME, $sqlParams);

// Trường tài khoản không tồn tại
if (count($account) == 0) {
    $responseService->createResponse(
        "error",
        [
            'msg_code' => 'E304',
            'msg' => 'Tài khoản hoặc mật khẩu không đúng!',
        ]
    );
}

$pepper = $userService->getPasswordPepper();
$rawPassword = $pepper . $password . $account['salt'];

// Trường hợp sai mật khẩu
$password = password_verify($rawPassword, $account['password']);
if (!$password) {
    $responseService->createResponse(
        "error",
        [
            'msg_code' => 'E304',
            'msg' => 'Tài khoản hoặc mật khẩu không đúng!'
        ]
    );
}

$responseService->createResponse(
    "ok",
    [
        'msg_code' => 'I300',
        'msg' => 'Đăng nhập thành công!'
    ]
);
