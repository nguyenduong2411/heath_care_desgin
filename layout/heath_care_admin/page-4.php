<?php
session_start();
if(!isset($_SESSION['user_session'])){
	header("Location: index.php");
}
include('header.php');
include('container.php');
include_once("db_connect.php");
$sql = "SELECT user_id, username, password, emailaddress FROM users WHERE user_id='".$_SESSION['user_session']."'";
$results = $conn->query($sql);
$row = $results->fetchAll();
?>
<div class="container">
  <div id="navbar" class="navbar-collapse collapse">
   <ul class="nav navbar-nav navbar-right">            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span>&nbsp;Chào! <?php echo $row[0]['username']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Xem thông tin người dùng</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Đăng xuất</a></li>
              </ul>
            </li>
          </ul>
	</div>	
	<div class='alert alert-success'>
		<button class='close' data-dismiss='alert'>&times;</button>
		<br>page-4<br><br>
  </div>	
</div>
<?php include('footer.php');?>