<?php
include 'products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Tạo ID mới
    $id = count($products) ? max(array_column($products, 'id')) + 1 : 1;

    // Thêm sản phẩm mới vào danh sách
    $products[] = ['id' => $id, 'name' => $name, 'price' => $price];

    // Lưu lại sản phẩm
    saveProducts($products);

    // Quay về trang chính
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Thêm sản phẩm</h1>
    <form method="POST" action="add_product.php">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá sản phẩm</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
