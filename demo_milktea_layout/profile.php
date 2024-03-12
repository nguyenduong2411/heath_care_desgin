<?php
include('./action/common/Template.php');

use action\common\Template;

$error = [];

// Kiểm tra tham số product_id có được truyền vào từ url
if (!isset($_GET['vmid'])) {
    throw new Exception("Không tìm thấy tham số vmid");
}

$data = [
    'title' => 'Bubble Tea House',
    'last_name' => "CURSH KO TRA LOI TIN NHAN",
    'vmid' => $_GET['vmid']
];

var_dump($_GET);

Template::Init('cache/', false);
Template::view('./views/profile.html', $data);
