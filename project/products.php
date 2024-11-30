<?php
// Mảng sản phẩm
// Hàm lưu sản phẩm vào file
function saveProducts($products) {
    file_put_contents('products.json', json_encode($products));
}

// Hàm tải sản phẩm từ file
function loadProducts() {
    if (file_exists('products.json')) {
        return json_decode(file_get_contents('products.json'), true);
    }
    return [];
}

// Load danh sách sản phẩm từ file
$products = loadProducts();
?>
