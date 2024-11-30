<?php
include 'products.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Xóa sản phẩm khỏi danh sách
    $products = array_filter($products, function ($p) use ($id) {
        return $p['id'] != $id;
    });

    // Lưu lại sản phẩm
    saveProducts($products);
}

// Quay về trang chính
header('Location: index.php');
exit;
?>
