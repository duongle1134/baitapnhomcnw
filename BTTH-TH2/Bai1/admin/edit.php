<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Cập nhật thông tin hoa
    $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $description, $image, $id);
    $stmt->execute();

    // Chuyển hướng về trang admin
    header("location: admin.php");
    exit;
}

// Lấy thông tin hoa theo ID
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM flowers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$flower = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hoa</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Chỉnh sửa hoa</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($flower['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($flower['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Link hình ảnh</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($flower['image']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật hoa</button>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Đóng kết nối
?>