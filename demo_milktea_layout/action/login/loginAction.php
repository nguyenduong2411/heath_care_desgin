<?php
include_once("../common/db_connect.php");

echo("call loginAction.php");
print_r($_POST);

session_start();
$userName = trim($_POST['username']);
$password = trim($_POST['password']);

if(isset($conn)) {
    $sql = "SELECT user_id, password, emailaddress FROM users WHERE username='$userName'";
    $results = $conn->query($sql);
    $row = $results->fetchAll();
    if($row[0]['password']==$password) {
        echo "ok";
        $_SESSION['user_session'] = $row[0]['user_id'];
        header('Location: /milktea/profile.html');
        exit();
    } else {
        echo "Địa chỉ email hoặc mật khẩu không hợp lệ!";
    }
} else {
    echo("lỗi kết nối!");
}