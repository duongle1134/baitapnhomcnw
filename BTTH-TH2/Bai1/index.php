<?php
require_once 'data.php';
require_once 'functions.php';
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Địa chỉ máy chủ
$username = "root"; // Tên người dùng
$password = ""; // Mật khẩu
$dbname = "flower_db"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách hoa từ cơ sở dữ liệu
$result = $conn->query("SELECT * FROM flowers");
$flowers = $result->fetch_all(MYSQLI_ASSOC); // Lấy tất cả hoa dưới dạng mảng

$conn->close(); // Đóng kết nối
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa đẹp</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè</h1>
        <div class="text-center mb-4">
            <?php if (!isset($_SESSION['loggedin'])): ?>
                <a href="login.php" class="btn btn-primary">Đăng nhập</a>
            <?php endif; ?>
        </div>
        <?php displayFlowersForGuests($flowers); ?>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>