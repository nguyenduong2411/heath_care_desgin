<?php
include_once("./action/common/PDOConnection.php");
include_once("./action/common/template.php");

$error = [];
// Kiểm tra tham số product_id có được truyền vào từ url
if (!isset($_GET['product_id'])) {
    throw new Exception("Không tìm thấy tham số product_id");
}

// Kiểm tra product_id có phải là số
if (!is_numeric($_GET['product_id'])) {
    throw new Exception("product_id bắt buộc phải là số!");
}

$sql = file_get_contents("./sql/GetProductById.sql");

// kiểm tra phát sinh lỗi khi thực hiện đọc file sql
if (!$sql) {
    throw new Exception("Lỗi! Phát sinh khi thực hiện đọc file sql");
}

// Kiểm tra nội dung trong file có bị trống
if (strlen($sql) == 0) {
    throw new Exception("Nội dung của file sql đang bị trống");
}

$data = ['title' => 'Bubble Tea House'];

try {
    $conn = PDOConnection::getConnection();
    $sth = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(['product_id' => $_GET["product_id"]]);

    $rows = $sth->fetchAll();

    if (count($rows) == 0) {
        header('Location: /milktea/product-not-found.html');
    }

    $product = $rows[0];
    $data['product_name'] = $product['name'];
    $data['category_name'] = $product['category_name'];
    $data['price'] = $product['price'];
    $data['description'] = $product['description'];
    $data['image_url'] = $product['image_url'];

} catch (Exception $e) {
    throw new Exception( $exception->getMessage() , (int)$exception->getCode());
}

Template::Init('cache/', false);
Template::view('./views/product-detail.html', $data);