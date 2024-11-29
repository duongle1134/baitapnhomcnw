<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'data.php';

// Lấy ID của loại hoa cần sửa từ URL
$flowerId = $_GET['id'];

// Lấy thông tin loại hoa từ CSDL
$sql = "SELECT * FROM flowers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $flowerId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Loài hoa không tồn tại.");
}

$flower = $result->fetch_assoc();

// Xử lý form khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $image, $flowerId);
    $stmt->execute();

    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Loài Hoa</title>
    <!-- Thêm Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Sửa Thông Tin Loài Hoa</h1>
    <form method="post">
        <!-- Ẩn chỉ mục hoa để xử lý cập nhật -->
        <input type="hidden" name="index" value="<?php echo $index; ?>">

        <!-- Trường nhập Tên Hoa -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên Hoa</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="<?php echo htmlspecialchars($flower['name']); ?>" required>
        </div>

        <!-- Trường nhập Mô Tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($flower['description']); ?></textarea>
        </div>

        <!-- Trường nhập URL Ảnh -->
        <div class="mb-3">
            <label for="image" class="form-label">URL Ảnh</label>
            <input type="text" class="form-control" id="image" name="image" 
                   value="<?php echo htmlspecialchars($flower['image']); ?>" required>
        </div>

        <!-- Nút Lưu Thay Đổi -->
        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>

        <!-- Nút Hủy -->
        <a href="admin.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<!-- Thêm Bootstrap JS -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
