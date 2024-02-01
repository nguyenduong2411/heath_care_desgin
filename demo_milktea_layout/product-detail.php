<?php
include('./action/service/ProductService.php');
include('./action/common/Template.php');

use action\service\ProductService;
use action\common\Template;

$error = [];
$productService = new ProductService();

// Kiểm tra tham số product_id có được truyền vào từ url
if (!isset($_GET['product_id'])) {
    throw new Exception("Không tìm thấy tham số product_id");
}

// Kiểm tra product_id có phải là số
if (!is_numeric($_GET['product_id'])) {
    throw new Exception("product_id bắt buộc phải là số!");
}

$sqlFilePath = './sql/GetProductById.sql';
$sqlParams = [
    'product_id' => $_GET["product_id"]
];

$product = $productService->GetProductById($sqlFilePath, $sqlParams);

if (count($product) == 0) {
    header('Location: /milktea/product-not-found.html');
}

$data = [
    'title' => 'Bubble Tea House',
    'category_name' => $product['category_name'],
    'product_name' => $product['name'],
    'price' => $product['price'],
    'description' => $product['description'],
    'image_url' => $product['image_url']
];

Template::Init('cache/', false);
Template::view('./views/product-detail.html', $data);
