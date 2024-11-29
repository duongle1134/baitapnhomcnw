<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flowers[] = [
        "name" => $_POST['name'],
        "description" => $_POST['description'],
        "image" => $_POST['image']
    ];
    file_put_contents('data.php', '<?php $flowers = ' . var_export($flowers, true) . '; ?>');
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hoa</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Thêm Loài Hoa</h1>
    <form method="post">
        <div class="form-group">
            <label for="name">Tên Hoa</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">URL Ảnh</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Lưu</button>
        <a href="admin.php" class="btn btn-secondary mt-3">Hủy</a>
    </form>
</div>
</body>
</html>
