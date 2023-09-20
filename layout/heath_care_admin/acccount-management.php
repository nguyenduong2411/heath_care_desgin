<?php
session_start();
if (!isset($_SESSION['user_session'])) {
  header("Location: index.php");
}
include('header.php');
include('container.php');
include_once("db_connect.php");

$sql = "SELECT user_id, username, password, emailaddress FROM users WHERE user_id='" . $_SESSION['user_session'] . "'";
$results = $conn->query($sql);
$row = $results->fetchAll();

$accounts_sql = "SELECT account_id, username, login_status, last_login FROM accounts";
$accounts_data = $conn->query($accounts_sql);
$accounts = $accounts_data->fetchAll(PDO::FETCH_ASSOC);
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
  <div>
    <h3>Danh sách tài khoản bệnh nhân</h3>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tên tài khoản</th>
        <th scope="col">Trạng thái đăng nhập</th>
        <th scope="col">Ngày đăng nhập cuối cùng</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($accounts as $account) {
        echo ('<tr>');
        echo ('<th scope="row">' . $account['account_id'] . '</th>');
        echo ('<td>'. $account['username'] .'</td>');
        if ($account['login_status'] == 1) {
          echo ('<td><span class="badge rounded-pill bg-success">online</span></td>');
        } else {
          echo ('<td><span class="badge rounded-pill bg-danger">offline</span></td>');
        }
        echo ('<td>'. $account['last_login'] .'</td>');
        echo ('<td><button type="button" class="btn btn-link">Chi tiết</button></td>');
        echo ('</tr>');
      }
      ?>
    </tbody>
  </table>
</div>
<?php include('footer.php'); ?>