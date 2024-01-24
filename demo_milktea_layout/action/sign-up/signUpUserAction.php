<?php
include_once("../common/PDOConnection.php");

$conn = PDOConnection::getConnection();

session_start();
$userName = trim($_POST['username']);
$password = trim($_POST['password']);
$email    = trim($_POST['email']);

if(!isset($conn)) {
    header('Location: /milktea/index.html');
}

$sql =  "INSERT INTO users(username, password, emailaddress, created_on, last_login) VALUES (?,?,?,now(),now())";

$stmt = $conn->prepare($sql);

try {

    $conn->beginTransaction();

    $stmt->execute(array($userName, $password, $email));

    $conn->commit();

    $newUserId = $conn->lastInsertId();

    if ($newUserId > 0) {
        header('Location: /milktea/profile.html');
    }

} catch(PDOException $exception) {

    $conn->rollback();

    throw new Exception( $exception->getMessage( ) , (int)$exception->getCode( ) );

}
