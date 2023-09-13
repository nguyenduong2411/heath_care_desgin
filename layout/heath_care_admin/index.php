<?php 
include('header.php');
include_once("db_connect.php");
?>
<title>Màn hình quản lý</title>
<script type="text/javascript" src="script/validation.min.js"></script>
<script type="text/javascript" src="script/login.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<?php include('container.php');?>
<div class="container">
	<h2>Chào mừng bạn đã truy cập vào trang quản lý của bệnh viện đa khoa An Tâm</h2>		
	<form class="form-login" method="post" id="login-form">
		<h2 class="form-login-heading">ĐĂNG NHẬP</h2><hr />
		<div id="error">
		</div>
		<div class="form-group">
			<input type="email" class="form-control" placeholder="Địa chỉ email" name="user_email" id="user_email" />
			<span id="check-e"></span>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Mật khẩu" name="password" id="password" />
		</div>
		<hr />
		<div class="form-group">
			<button type="submit" class="btn btn-default" name="login_button" id="login_button">
			<span class="glyphicon glyphicon-log-in"></span> &nbsp; Đăng nhập
			</button> 
		</div> 
	</form>
</div>
<?php include('footer.php');?>