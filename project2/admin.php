<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'data.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Hoa</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Quản lý Loài Hoa</h1>
    <a href="admin/add.php" class="btn btn-success mb-3">Thêm Loài Hoa</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Tên Hoa</th>
            <th>Mô Tả</th>
            <th>Ảnh</th>
            <th>Hành Động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($flowers as $index => $flower): ?>
            <tr>
                <td><?php echo $flower['name']; ?></td>
                <td><?php echo $flower['description']; ?></td>
                <td><img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>" width="100"></td>
                <td>
                    <a href="admin/edit.php?index=<?php echo $index; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="admin/delete.php?index=<?php echo $index; ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
