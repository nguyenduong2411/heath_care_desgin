<?php
session_start();
include_once("db_connect.php");
if(isset($_POST['login_button'])) {
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['password']);
	
	$sql = "SELECT user_id, password, emailaddress FROM users WHERE emailaddress='$user_email'";
	$results = $conn->query($sql);
	$row = $results->fetchAll();
		
	if($row[0]['password']==$user_password){				
		echo "ok";
		$_SESSION['user_session'] = $row[0]['user_id'];
	} else {				
		echo "Địa chỉ email hoặc mật khẩu không hợp lệ!";
	}	
}
?>